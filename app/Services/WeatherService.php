<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class WeatherService
{
    protected $apiKey;

    // Barangay coordinates for Tayabas (use the list you already have)
    protected $barangayCoordinates = [
        'Alupay' => ['lat' => 13.9246, 'lon' => 121.6054],
        'Angeles' => ['lat' => 13.9298, 'lon' => 121.5962],
        'Anos' => ['lat' => 13.9391, 'lon' => 121.5904],
        'Bagumbayan' => ['lat' => 13.9397, 'lon' => 121.6026],
        'Calumpang' => ['lat' => 13.9330, 'lon' => 121.6083],
        'Dapdap' => ['lat' => 13.9152, 'lon' => 121.5995],
        'Domit' => ['lat' => 13.9214, 'lon' => 121.6031],
        'Ipilan' => ['lat' => 13.9309, 'lon' => 121.5876],
        'Lalo' => ['lat' => 13.9283, 'lon' => 121.5917],
        'Opias' => ['lat' => 13.9205, 'lon' => 121.5908],
        'Palale' => ['lat' => 13.9221, 'lon' => 121.6042],
        'San Diego' => ['lat' => 13.9357, 'lon' => 121.5989],
        // Add all 66 barangays here as needed
    ];

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    // Get weather data for a barangay
    public function getWeather($barangay)
    {
        // Check if the barangay coordinates exist
        if (!isset($this->barangayCoordinates[$barangay])) {
            return ['error' => "Coordinates not found for $barangay"];
        }

        $lat = $this->barangayCoordinates[$barangay]['lat'];
        $lon = $this->barangayCoordinates[$barangay]['lon'];

        // Cache key based on barangay name and 3-hour interval forecast
        $cacheKey = "weather_{$barangay}_3hour_forecast";

        return Cache::remember($cacheKey, 10800, function () use ($lat, $lon) {
            return $this->fetchWeatherFromAPI($lat, $lon);
        });
    }

    // Fetch weather data from the OpenWeather API
    private function fetchWeatherFromAPI($lat, $lon)
    {
        // URL for the OpenWeather 3-hour forecast
        $url = "https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric";
        $response = Http::get($url);

        // If the API request fails, log the error and return a message
        if ($response->failed()) {
            Log::error('Weather API Error: ', $response->json());
            return ['error' => 'Weather data not found. Check API key or city name.'];
        }

        // Process and return the forecast data
        $data = $response->json();
        return [
            'forecast' => $this->processForecast($data['list']),
            'source' => 'api'
        ];
    }

    // Process the forecast data, adjusting for Manila time and formatting
    private function processForecast($list)
    {
        $forecastData = [];

        // Loop through each forecast entry (every 3 hours)
        foreach ($list as $forecast) {
            // Get the UTC timestamp for the forecast time
            $utcTimestamp = $forecast['dt'];

            // Subtract 3 hours to adjust for OpenWeather's API time shift (if needed)
            $correctedTimestamp = $utcTimestamp - (3 * 3600);

            // Convert the timestamp to Manila time (Asia/Manila)
            $datetime = Carbon::createFromTimestampUTC($correctedTimestamp)
                ->setTimezone('Asia/Manila')
                ->format('Y-m-d h:i A');

            // Prepare the formatted forecast data
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
