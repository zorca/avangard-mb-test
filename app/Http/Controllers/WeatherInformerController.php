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
                'lat' =>'34.36667',
                'lon' => '53.25000',
            ],
            'kaluga' => [
                'name' => 'Калуга',
                'lat' => '36.266670',
                'lon' => '54.533330',
            ],
        ];

        $cityInfo = Arr::first($cities, function ($key, $value) use ($city) {
            return $value === $city;
        });

        if (!$cityInfo) {
            abort(404, __('City not found'));
        }

        $httpClient = new Client();

        $url = sprintf('https://api.weather.yandex.ru/v2/informers??lat=%s&lon=%s&lang=ru_RU', $cityInfo['lat'], $cityInfo['lon']);

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
