<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Weather
{

    public function weatherInfo()
    {
        $apiKey = "c35b68dd5e194fd9b4d195451221706";
        $coordinate = "40.889489, 29.717636";
        $http = Http::get("http://api.weatherapi.com/v1/current.json?key=" . $apiKey . "&q=" . $coordinate);
        $status = $http->status();
        $body = $http->body();
        $data = [];
        if ($status == 200) {
            $bodyDecode = json_decode($body, true);

            ## temp sıcaklık
            $tempC = $bodyDecode['current']['temp_c'];

            ### condition
            $conditionText = $bodyDecode['current']['condition']['text'];
            $conditionIcon = $bodyDecode['current']['condition']['icon'];

            ### rüzgar
            $windDegree = $bodyDecode['current']['wind_degree']; #rüzgar açısı
            $windDir = $bodyDecode['current']['wind_dir']; #rüzgar yönü
            $windKph = $bodyDecode['current']['wind_kph']; #rüzgar hızı
            $isDay = $bodyDecode['current']['is_day']; # 1 gündüz  0 gece

            $precipMm = $bodyDecode['current']['precip_mm']; # beklenen yağış miktarı
            $humidity = $bodyDecode['current']['humidity']; # humidity
            $pressureMb=$bodyDecode['current']['pressure_mb']; # basınç milibar cinsinden
            $cloud = $bodyDecode['current']['cloud']; # bulut indeksi
            $feelsLikeC = $bodyDecode['current']['feelslike_c']; # hissedilen sıcaklık
            $visKm = $bodyDecode['current']['vis_km']; # görüş mesafesi
            $uv = $bodyDecode['current']['uv'];# ultraviyole
            $gustKph = $bodyDecode['current']['gust_kph']; #
            $data = [
                'data' => [ 'condition' => [
                    'title' => $conditionText,
                    'icon' => $conditionIcon
                ],
                    'temp_c' => $tempC,

                    'wind_degree' => $windDegree,
                    'wind_dir' => $windDir,
                    'wind_kph' => $windKph,
                    'precip_mm' => $precipMm,
                    'is_day' =>$isDay == 1 ? 'Day' : 'Night',
                    'humidity' => $humidity,
                    'cloud' => $cloud,
                    'feelslike_c' => $feelsLikeC,
                    'vis_km' => $visKm,
                    'uv' => $uv,
                    'gust_kph' => $gustKph,
                    'pressure_mb'=>$pressureMb
                ],
                'success' => true,
                'status' => $status
            ];
        } else {
            $data = [
                'success' => false,
                'status' => $status
            ];
        }
        return $data;
    }
}
