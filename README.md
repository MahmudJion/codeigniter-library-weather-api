# CodeIgniter Library - Weather API

This project provides a CodeIgniter library to fetch the current weather based on the user's geolocation using their IP address. It integrates with the [OpenWeather API](https://openweathermap.org/api) and the [IP-API](http://ip-api.com/) for geolocation.

---

## Features
- Detects user location based on their IP address.
- Fetches current weather data (temperature, weather conditions, etc.) using the OpenWeather API.
- Easy integration with CodeIgniter projects.

---

## Requirements
- PHP 7.4 or higher (PHP 8.0+ recommended)
- CodeIgniter 3.x
- Composer (for dependency management)
- OpenWeather API key

---

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-repo/codeigniter-library-weather-api.git
   ```

2. **Install Dependencies**:
   Navigate to the project directory and run:
   ```bash
   composer install
   ```

3. **Set Up Environment Variables**:
   Create a `.env` file in the root of your project and add your OpenWeather API key:
   ```env
   OPENWEATHER_API_KEY=your_api_key_here
   ```

4. **Load the Library in CodeIgniter**:
   In your controller, load the `Weather` library:
   ```php
   $this->load->library('Weather');
   ```

---

## Usage

### Fetching Location Data
To get the user's location based on their IP address:
```php
$location = $this->weather->get_location_api();
echo "City: " . $location->city;
echo "Country: " . $location->countryCode;
```

### Fetching Weather Data
To get the current weather for the user's location:
```php
$weather = $this->weather->get_weather_api();
echo "Temperature: " . $weather->main->temp . "°C";
echo "Weather: " . $weather->weather[0]->description;
```

---

## Example Controller
Here’s an example of how to use the library in a controller:
```php
class WeatherController extends CI_Controller
{
    public function index()
    {
        $this->load->library('Weather');

        $location = $this->weather->get_location_api();
        $weather = $this->weather->get_weather_api();

        $data = [
            'city' => $location->city,
            'country' => $location->countryCode,
            'temperature' => $weather->main->temp,
            'description' => $weather->weather[0]->description
        ];

        $this->load->view('weather_view', $data);
    }
}
```

---

## Dependencies
- [GuzzleHTTP](https://github.com/guzzle/guzzle): For making HTTP requests.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): For managing environment variables.

---

## License
This project is licensed under the MIT License. See the `license.txt` file for details.

---

## References
- [OpenWeather API Documentation](https://openweathermap.org/api)
- [IP-API Documentation](http://ip-api.com/)
- [CodeIgniter User Guide](https://codeigniter.com/userguide3/)
