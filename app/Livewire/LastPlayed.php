<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class LastPlayed extends Component
{

    public $songTitle;
    public $songArtist;
    public $songImage;
    public $elementToShow;
    public $lastThreeSongs;

    public $cachedData;

    public function render()
    {
      /*   $cachedData = Cache::get('last_three_songs');
        if ($cachedData) {
            $this->lastThreeSongs = $cachedData;
        }
        return view('livewire.last-played', ['lastThreeSongs' => $this->lastThreeSongs]); */
    }

    public function mount()
    {
       /*  $this->fetchPreviousSongData(); */
    }

    public function placeholder()
    {
/*         return view('skeletons.skeleton-lastPlayed'); */
    }


    public function fetchPreviousSongData()
    {

      /*   $cacheKey = 'last_three_songs';
        return Cache::remember($cacheKey, now()->addMinutes(2), function () {
            $response = Http::get('http://138.197.88.112/api/proc/s/song_history');
            $data = $response->json();

            return array_slice($data['songs'], 0, 3);

        });
 */

    }
}

