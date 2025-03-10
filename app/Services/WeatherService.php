<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    public function getWeather($city)
    {
        $cacheKey = "weather_data_3hour_" . strtolower($city);

        return Cache::remember($cacheKey, 10800, function () use ($city) {
            return $this->fetchWeatherFromAPI($city);
        });
    }

    private function fetchWeatherFromAPI($city)
    {
        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$this->apiKey}&units=metric";
        $response = Http::get($url);

        if ($response->failed()) {
            Log::error('Weather API Error: ', $response->json());
            return ['error' => 'Weather data not found. Check API key or city name.'];
        }

        $data = $response->json();
        return [
            'city' => $data['city']['name'],
            'country' => $data['city']['country'],
            'forecast' => $this->processForecast($data['list']),
            'source' => 'api'
        ];
    }

    private function processForecast($list)
    {
        $forecastData = [];

        foreach ($list as $forecast) {
            $datetime = date('Y-m-d H:i', $forecast['dt']);  // Format datetime to include time
            $forecastData[] = [
                'datetime' => $datetime,
                'temperature' => $forecast['main']['temp'],
                'weather' => $forecast['weather'][0]['description'],
                'icon' => $forecast['weather'][0]['icon'],
            ];
        }

        return $forecastData;
    }
}
