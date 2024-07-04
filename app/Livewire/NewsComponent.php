<?php

namespace App\Livewire;
use Livewire\Component;

use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;

class NewsComponent extends Component
{

    public $author;
    public $title;
    public $description;
    public $urlImage;
    public $lastThreeNews;

    #[Lazy]
    public function render()
    {

        return view('livewire.news-component');
    }

    public function mount(){

        $this->getNews();
    }

    public function getNews(){

        $apiKey= 'a564b76f0b00469a9846d99efd222db4';
        $request = Http::get('https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=' . $apiKey);
        $data = $request->json();

        return $this->lastThreeNews = array_slice($data['articles'], 0, 3);
    }

}

