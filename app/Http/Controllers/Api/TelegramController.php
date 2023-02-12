<?php

namespace App\Http\Controllers\Api;

use App\Events\TelegramSupport;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TelegramResource;
use App\Models\Telegram;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    //telegram set webhook
    public function setWebhook()
    {
        $url = env('TELEGRAM_WEBHOOK_URL', null);
        $api = new Api();
        $api->setWebhook(['url' => $url]);
        return "telegram";
    }

    // telegram webhook listen and data parse etme
    public function webhook(Request $request)
    {

        \Log::info('telegram-webhook-data', $request->all());
        $api = new Api();
        $messages = $request->all();
        $data = [];
        if (array_key_exists('message', $messages)) {


            $messages = $messages['message'];
            $messageID = $messages['message_id'];
            $date = Carbon::createFromTimestamp($messages['date'])->format("Y-m-d H:i:s");

            $chatID = $messages['chat']['id'];
            $firstName = $messages['chat']['first_name'];
            $lastName = $messages['chat']['last_name'];
            $username = $messages['chat']['username'];
            $languageCode = $messages['from']['language_code'];

            $fullName = $firstName . " " . $lastName;

            $actionType = null;
            $actionValue = null;

            $timestamp = $messages['date'];
            $folder = 'upload/file';
            $path = public_path($folder) . "/";

            ### text
            if (array_key_exists('text', $messages)) {
                $actionValue = $messages['text'];
                $actionType = "text";

            } ### photo
            else if (array_key_exists('photo', $messages)) {
                $photo = $messages['photo'];
                if (count($photo) > 0) {
                    $fileID = $photo[count($photo) - 1]['file_id'];
                    $getFile = $api->getFile(['file_id' => $fileID]);
                    $getFilePath = $getFile['file_path'];
                    $fileFullPath = env('API_TELEGRAM_URL', null) . env('TELEGRAM_BOT_TOKEN') . "/" . $getFilePath;

                    $fileName = $timestamp . ".jpg";
                    Helper::download($fileFullPath, $path . $fileName);

                    $url = url($folder . "/" . $fileName);
                    ### action
                    $actionType = "photo";
                    $actionValue = $url;
                }

            } ### video
            else if (array_key_exists('video', $messages)) {
                $video = $messages['video'];

                ### file info
                $fileID = $video['file_id'];
                $fileMimeType = $video['mime_type'];
                $getFile = $api->getFile(['file_id' => $fileID]);
                $getFilePath = $getFile['file_path'];

                ### get extension
                $extension = Helper::mime2ext($fileMimeType);


                ### file name
                $fileName = $timestamp . "." . $extension;
                $fileFullPath = env('API_TELEGRAM_URL', null) . env('TELEGRAM_BOT_TOKEN') . "/" . $getFilePath;
                Helper::download($fileFullPath, $path . $fileName);

                $url = url($folder . "/" . $fileName);

                ### action
                $actionValue = $url;
                $actionType = "video";
            } ### location
            else if (array_key_exists('location', $messages)) {
                $location = $messages['location'];

                $actionValue = json_encode([
                    'latitude' => $location['latitude'],
                    'longitude' => $location['longitude'],
                ]);
                $actionType = "location";
            }

            $data = Helper::telegramMessageSave($chatID, $messageID, $firstName, $lastName, $username, $date, $actionType, $actionValue, $languageCode, $fullName);
        } else if (array_key_exists('my_chat_member', $messages)) {
            $messages = $messages['my_chat_member'];
            $messageID = 0;
            $date = Carbon::createFromTimestamp($messages['date'])->format("Y-m-d H:i:s");

            $chatID = $messages['chat']['id'];
            $firstName = $messages['chat']['first_name'];
            $lastName = $messages['chat']['last_name'];
            $username = $messages['chat']['username'];
            $languageCode = $messages['from']['language_code'];
            $actionValue = null;
            $actionType = null;
            $fullName = $firstName . " " . $lastName;

            $data = Helper::telegramMessageSave($chatID, $messageID, $firstName, $lastName, $username, $date, $actionType, $actionValue, $languageCode, $fullName);
        }
        event(new TelegramSupport(($data)));
    }

    // telegram list
    public function list(Request $request): JsonResponse
    {

        $perPageLimit = 12;

        $success = false;
        $title = "Telegram / Veri";

        $type = "info";

        $list = [];
        $paging = [];
        $message = "Kayıt bulunamadı.";
        $telegramList = Telegram::select(DB::raw('
            id,
            first_name,
            last_name,
            date,
            action_type,
            action_value
        '))->orderBy('date', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $telegramList = $telegramList->where('full_name', 'LIKE', '%' . $search . '%');
        }

        $telegramList = $telegramList->paginate($perPageLimit);

        if ($telegramList->count() > 0) {
            $list = TelegramResource::collection($telegramList);

            $paging = [
                'per_page' => (int)$perPageLimit,
                'current_page' => $telegramList->currentPage(),
                'last_page' => $telegramList->lastPage(),
                'total' => $telegramList->total()
            ];
            $code = 200;
            $type = "success";
            $success = true;
            $message = "Kayıtlar getirildi.";
        } else {
            $code = 200;
        }

        $data = [

            'title' => $title,
            'success' => $success,
            'message' => $message,
            'type' => $type
        ];
        if ($success) {
            $data['list'] = $list;
            $data['paging'] = $paging;
        }

        return response()->json($data, $code);
    }

    public function detail($id): JsonResponse
    {
        $perPageLimit = 12;

        $success = false;
        $title = "Telegram / Veri";

        $type = "info";

        $list = [];
        $paging = [];
        $message = "Kayıt bulunamadı.";
        $telegram = Telegram::select(DB::raw('
            id,
            first_name,
            last_name,
            date,
            action_type,
            action_value
        '))->where('id', '=', $id);


        if ($telegram->count() > 0) {
            $telegram = $telegram->first()->toArray();

            $id = $telegram['id'];
            $date = $telegram['date'];
            $actionType = $telegram['action_type'];
            $actionValue = $telegram['action_value'];
            $firstName = $telegram['first_name'];
            $lastName = $telegram['last_name'];

            $telegram['date'] = Helper::dateTranslatedFormat($date, "d F Y");
            $telegram['hour'] = Helper::dateTranslatedFormat($date, "H:i:s");

            if ($actionType == "location") {
                $telegram['action_value'] = json_decode($actionValue);
            }
            $telegram['first_name'] = substr($firstName, 0, 1) . "*****";
            $telegram['last_name'] = substr($lastName, 0, 1) . "*****";

            $telegram['share_link']=url('preview')."/".$id;
            $list = $telegram;

            $code = 200;
            $type = "success";
            $success = true;
            $message = "Kayıtlar getirildi.";
        } else {
            $code = 200;
        }

        $data = [

            'title' => $title,
            'success' => $success,
            'message' => $message,
            'type' => $type
        ];
        if ($success) {
            $data['list'] = $list;
        }

        return response()->json($data, $code);
    }
}
