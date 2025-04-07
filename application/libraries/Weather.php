<?php

use GuzzleHttp\Client;

class Weather
{
    private $httpClient;
    private $apiKey;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->apiKey = getenv('OPENWEATHER_API_KEY'); // Load API key from environment variables
    }

    public function get_location_api()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        try {
            $response = $this->httpClient->get("http://ip-api.com/json/" . $ip);
            $data = json_decode($response->getBody());
            return $data;
        } catch (Exception $e) {
            // Handle errors gracefully
            return (object) ['city' => 'Unknown', 'countryCode' => 'XX'];
        }
    }

    public function get_weather_api()
    {
        $get_location = $this->get_location_api();

        $city = htmlspecialchars($get_location->city);
        $country = htmlspecialchars($get_location->countryCode);

        try {
            $response = $this->httpClient->get('http://api.openweathermap.org/data/2.5/weather', [
                'query' => [
                    'q' => $city . ',' . $country,
                    'appid' => $this->apiKey,
                    'units' => 'metric' // Get temperature in Celsius directly
                ]
            ]);

            $jsonobj = json_decode($response->getBody());
            return $jsonobj;
        } catch (Exception $e) {
            // Handle errors gracefully
            return (object) ['error' => 'Unable to fetch weather data'];
        }
    }
}

