<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class WeatherInformerController extends Controller
{
    public function show(string $city)
    {
        $cities = [
            'bryansk' => [
                'name' => 'Брянск',
                'lat' =>'53.2521',
                'lon' => '34.3717',
            ],
            'kaluga' => [
                'name' => 'Калуга',
                'lat' => '54.5293',
                'lon' => '36.2754',
            ],
            'kazan' => [
                'name' => 'Казань',
                'lat' => '55.7887',
                'lon' => '49.1221',
            ],
        ];

        $cityInfo = Arr::first($cities, function ($key, $value) use ($city) {
            return $value === $city;
        });

        if (!$cityInfo) {
            abort(404, __('City not found'));
        }

        $httpClient = new Client();

        $url = sprintf('https://api.weather.yandex.ru/v2/informers?lat=%s&lon=%s&lang=ru_RU', $cityInfo['lat'], $cityInfo['lon']);

        try {
            $response = $httpClient->get( $url, ['headers' => ['X-Yandex-API-Key' => config('weather.yandex_weather_api_key')]]);
        } catch (\Exception $exception) {
            abort(500, 'Yandex Weather API error');
        }

        $weatherData = json_decode($response->getBody()->getContents(), true);

        $weatherTemperature = Arr::get($weatherData, 'fact.temp');

        return view('weather', ['cityInfo' => $cityInfo, 'weatherTemperature' => $weatherTemperature]);
    }
}
