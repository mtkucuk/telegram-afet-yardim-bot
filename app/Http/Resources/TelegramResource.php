<?php

namespace App\Http\Resources;

use App\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class TelegramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $telegram=$this;

        $id=$telegram['id'];

        $date=$telegram['date'];
        $actionType=$telegram['action_type'];
        $actionValue=$telegram['action_value'];
        $firstName=$telegram['first_name'];
        $lastName=$telegram['last_name'];

        $telegram['date']=Helper::dateTranslatedFormat($date,"d F Y");
        $telegram['hour']=Helper::dateTranslatedFormat($date,"H:i:s");

        if($actionType=="location"){
            $telegram['action_value']=json_decode($actionValue);
        }
        $telegram['first_name']=substr($firstName,0,1)."*****";
        $telegram['last_name']=substr($lastName,0,1)."*****";

        $telegram['share_link']=url('preview')."/".$id;
        return parent::toArray($telegram);
    }
}
