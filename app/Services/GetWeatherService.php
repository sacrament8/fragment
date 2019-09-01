<?php

namespace App\Services;

use Carbon\Carbon;

class GetWeatherService
{
    public function getWeather($user)
    {
        if (!empty($user->userInformation->pref)) {
            switch ($user->userInformation->pref) {
                case '北海道':
                    $city = '016010';
                    break;
                case '青森県':
                    $city = '020010';
                    break;
                case '岩手県':
                    $city = '030010';
                case '宮城県':
                    $city = '040010';
                    break;
                case '秋田県':
                    $city = '050010';
                    break;
                case '山形県':
                    $city = '060010';
                    break;
                case '福島県':
                    $city = '070010';
                    break;
                case '茨城県':
                    $city = '080010';
                    break;
                case '栃木県':
                    $city = '090010';
                    break;
                case '群馬県':
                    $city = '100010';
                    break;
                case '埼玉県':
                    $city = '110010';
                    break;
                case '千葉県':
                    $city = '120010';
                    break;
                case '東京都':
                    $city = '130010';
                    break;
                case '神奈川県':
                    $city = '140010';
                    break;
                case '新潟県':
                    $city = '150010';
                    break;
                case '富山県':
                    $city = '160010';
                    break;
                case '石川県':
                    $city = '170010';
                    break;
                case '福井県':
                    $city = '180010';
                    break;
                case '山梨県':
                    $city = '190010';
                    break;
                case '長野県':
                    $city = '200010';
                    break;
                case '岐阜県':
                    $city = '210010';
                    break;
                case '静岡県':
                    $city = '220010';
                    break;
                case '愛知県':
                    $city = '230010';
                    break;
                case '三重県':
                    $city = '240010';
                    break;
                case '滋賀県':
                    $city = '250010';
                case '京都府':
                    $city = '260010';
                    break;
                case '大阪府':
                    $city = '270000';
                    break;
                case '兵庫県':
                    $city = '280010';
                    break;
                case '奈良県':
                    $city = '290010';
                    break;
                case '和歌山県':
                    $city = '300010';
                    break;
                case '鳥取県':
                    $city = '310010';
                    break;
                case '島根県':
                    $city = '320010';
                    break;
                case '岡山県':
                    $city = '330010';
                    break;
                case '広島県':
                    $city = '340010';
                    break;
                case '山口県':
                    $city = '350010';
                    break;
                case '徳島県':
                    $city = '360010';
                    break;
                case '香川県':
                    $city = '370000';
                    break;
                case '愛媛県':
                    $city = '380010';
                    break;
                case '高知県':
                    $city = '390010';
                    break;
                case '福岡県':
                    $city = '400010';
                    break;
                case '佐賀県':
                    $city = '410010';
                    break;
                case '長崎県':
                    $city = '420010';
                    break;
                case '熊本県':
                    $city = '430010';
                    break;
                case '大分県':
                    $city = '440010';
                    break;
                case '宮崎県':
                    $city = '450010';
                    break;
                case '鹿児島県':
                    $city = '460010';
                    break;
                case '沖縄県':
                    $city = '471010';
                    break;
            }
        } else {
            $city = '130010';
        }

        $client = new \GuzzleHttp\Client();
        $uri = "http://weather.livedoor.com/forecast/webservice/json/v1";
        $res = $client->request('GET', $uri, [
            'query' => ['city' => $city],
        ]);

        $data = json_decode($res->getBody(), true);
        $weather = $data['forecasts'];
        $dateLabel = $data['forecasts']['0']['dateLabel'];
        $date = $data['forecasts']['0']['date'];
        $datetemp = new Carbon($date);
        $pref = $data['location']['prefecture'];
        $dateFormated = $datetemp->format('Y年m月d日');
        $telop = $data['forecasts']['0']['telop'];
        return "{$dateLabel}({$dateFormated})の{$pref}の天気は{$telop}です。";
    }
}
