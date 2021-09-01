<?php

class Weather
{
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

        $data = file_get_contents("http://ip-api.com/json/" . $ip);
        return $client_array = json_decode($data);
    }

    public function get_weather_api()
    {

        $get_location = $this->get_location_api();

        $city = htmlspecialchars($get_location->city);
        $country = htmlspecialchars($get_location->countryCode);

        $request = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . ',' . $country . '&appid="APP_ID"';

        $response = file_get_contents($request);
        
        $kelvin = $jsonobj->main->temp;
        $celcius = $kelvin - 273.15;

        return $jsonobj = json_decode($response);

    }

}

