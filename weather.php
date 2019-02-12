<?php 
$ip = '';
$api = 'https://ipapi.co/' . $ip . '/latlong/';
$location = file_get_contents($api);
$point = explode(",", $location);

$request= 'http://api.openweathermap.org/data/2.5/weather?lat=' . $point[0] . '&lon=' . $point[1] . '&appid=YOUR API KEY  ';
$response = file_get_contents($request);
$jsonobj = json_decode($response);
$kelvin = $jsonobj->main->temp;  

$celcius = $kelvin - 273.15; 

$url = 'http://ip-api.com/json/?fields=city';
$data = file_get_contents($url); 
$characters = json_decode($data);

echo "<br>$celcius";
echo "<br>$characters->city";
echo "<br>$location";
?> 
