<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class MeteoComponent extends Component
{
    public $temperature;
    public $long;
    public $lati;
    protected $listeners = ['fetchWeatherData'];
    public $weatherDescription;



    #[On('fetchWeatherData')]
    public function fetchWeatherData($long, $lati)
    {
        try {

            $this->long = $long;
            $this->lati = $lati;
            $response = Http::get("https://api.open-meteo.com/v1/forecast?latitude={$lati}&longitude={$long}&current=temperature_2m,apparent_temperature,is_day&hourly=temperature_2m&daily=weather_code,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min&timezone=auto");

            $data = $response->json();
            Log::info('fetchWeatherData event received with latitude: ' . $this->lati . ' and longitude: ' . $this->long);
            $user_location = $this->getUserLocation($long, $lati);
            // Verifica se ci sono dati presenti
            if (!empty($data) && $user_location == 'Europe') {
                $this->temperature = $data['current']['temperature_2m']. '°C';
                $this->weatherDescription = $data['current']['is_day'] ? 'Daytime' : 'NightTime';
            } elseif (!empty($data) && $user_location == 'Non-Europe') {
                $this->temperature = $data['current']['temperature_2m']. '°F';
                $this->weatherDescription = $data['current']['is_day'] ? 'Daytime' : 'NightTime';
            }else{
                $this->temperature = null;
                $this->weatherDescription = 'Geolocalization error or need to allow location access';
            }
        } catch (\Exception $e) {
            $this->temperature = null;
            $this->weatherDescription = 'Failed to retrieve weather data';
            // Puoi aggiungere un log dell'errore se necessario
            Log::error($e->getMessage());
        }
    }

    #[On('fetchWeatherData')]
    public function getUserLocation($long, $lati){
        $response = Http::get("https://nominatim.openstreetmap.org/reverse?lat=$lati&lon=$long&format=json");
        $data = $response->json();

        $country = $data['address']['country'];
        $european_countries = ['Austria', 'Belgium', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France', 'Germany', 'Italia'];
        if(in_array($country, $european_countries)){
            return 'Europe';
        }else{
            return 'Non-Europe';
        }
    }

    public function render()
    {
        return view('livewire.meteo-component');
    }

}
