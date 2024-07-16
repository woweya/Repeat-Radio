<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;


class MeteoComponent extends Component
{
    public $temperature;

    public $error;

    public $long;
    public $lati;

    public $weatherDescription;



    #[On('fetchWeatherData')]
    public function fetchWeatherData($long, $lati)
    {
        try {
            $this->long = $long;
            $this->lati = $lati;

            $response = Http::get("https://api.open-meteo.com/v1/forecast", [
                'latitude' => $lati,
                'longitude' => $long,
                'current' => 'temperature_2m,apparent_temperature,is_day',
                'hourly' => 'temperature_2m',
                'daily' => 'weather_code,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min',
                'timezone' => 'auto',
            ]);

            dd($response);

            $data = $response->json();
            dd($data);

            Log::info('fetchWeatherData event received with latitude: ' . $this->lati . ' and longitude: ' . $this->long);

            $user_location = $this->getUserLocation($long, $lati);

            if (!empty($data)) {
                $this->temperature = $this->formatTemperature($data['current']['temperature_2m'], $user_location);
                $this->weatherDescription = $data['current']['is_day'] ? 'Daytime' : 'NightTime';
            } else {
                $this->temperature = null;
                $this->weatherDescription = 'Failed to retrieve weather data';
            }
        } catch (\Exception $e) {
            $this->temperature = null;
            $this->weatherDescription = 'Failed to retrieve weather data';
            $this->error = 'Failed to retrieve weather data';
            Log::error($e->getMessage());
        }
    }

    protected function formatTemperature($temperature, $user_location)
    {
        if ($user_location == 'Europe') {
            return $temperature . '°C';
        } else {
            // Assuming non-European countries use Fahrenheit
            return $temperature . '°F';
        }
    }

    #[On('fetchWeatherData')]
    public function getUserLocation($long, $lati){
       try{
        $response = Http::get("https://nominatim.openstreetmap.org/reverse?lat=$lati&lon=$long&format=json");


        $data = $response;

        $country = $data['address']['country'];

        // List of European countries
        $european_countries = [
            'Austria', 'Belgium', 'Bulgaria', 'Croatia', 'Cyprus',
            'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France',
            'Germany', 'Greece', 'Hungary', 'Ireland', 'Italia', 'Latvia',
            'Lithuania', 'Luxembourg', 'Malta', 'Netherlands', 'Poland',
            'Portugal', 'Romania', 'Slovakia', 'Slovenia', 'Spain', 'Sweden'
        ];

        return in_array($country, $european_countries) ? 'Europe' : 'Non-Europe';
       }catch(\Exception $e){
           return $this->error = 'Failed to retrieve weather data';
       }
    }

    public function render()
    {
        return view('livewire.meteo-component');
    }

    public function placeholder(){
        return view('skeletons.skeleton-meteo');
    }

}
