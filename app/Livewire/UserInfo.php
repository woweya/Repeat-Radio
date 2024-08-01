<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\View\Components\layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserInfo extends Component
{
    use WithFileUploads;
    public $image;
    public $user;

    public $AboutMe = false;
    public $SocialsInfos = false;
    public $ContactInfos = false;
    public $isEditingWebsiteURL = false;
    public $isEditingName = false;

    public $isEditingCountry = false;
    public $isEditingBirthday = false;
    public $PrivateProfile = false;

    public $isEditingQuote = false;

    //Texts
    #[Validate]
    public $WebsiteURL = '';

    #[Validate]
    public $quote = '';

    #[Validate]
    public $name = '';

    #[Validate]
    public $AboutMeText = '';

    #[Validate]
    public $Birthday;

    #[Validate]
    public $Country;

    public $City;

    public $countries = [];

    public $cities = [];

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user) {
            $this->AboutMe = $this->user->about_me;
            $this->SocialsInfos = $this->user->social_infos;
            $this->ContactInfos = $this->user->contact_infos;
            $this->PrivateProfile = $this->user->private_profile;
            $this->WebsiteURL = $this->user->website_url;
            $this->Birthday = $this->user->birthday;
            $this->AboutMeText = $this->user->about_me_text;
            $this->Country = $this->user->country;
            $this->City = $this->user->city;
            $this->quote = $this->user->quote;
        }
        $this->fetchCountries();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'Birthday' => 'required|date',
            'Country' => 'required',
            'City' => 'required',
            'WebsiteURL' => 'nullable|url',
            'quote' => 'required|min:3',
        ];
    }

    public function render()
    {
        return view('livewire.user-info')->layout('components.layout');
    }




    public function editUser($userID)
    {

        $this->user = \App\Models\User::find($userID);
    }


    #[On('uploadImage')]
    public function sendRequest()
    {
        $this->dispatch('uploadImage');
    }


    public function updatedWebsiteURL()
    {
        if ($this->user) {
            $this->user->website_url = $this->WebsiteURL;
            $this->user->save();
            $this->isEditingWebsiteURL = false;
        }
    }


    public function enableEditingCountry()
    {
        $this->isEditingCountry = true;
        $this->dispatch('countryIsChanging');
    }

    public function enableEditingQuote()
    {
        $this->isEditingQuote = true;
        $this->updatedQuote();
    }

    #[Computed]
    public function getUpdatedQuote()
    {
        return $this->quote;
    }

    //Firstly fetching Countries
    public function fetchCountries()
    {
        try {
            $response = Http::get('https://restcountries.com/v3.1/all');
            $this->countries = $response->json();
        } catch (\Throwable $th) {
            $this->countries = [];
        }
    }

    public function fetchCities($countryCode)
    {
        try {
            $response = Http::get("http://api.geonames.org/searchJSON?country={$countryCode}&featureClass=P&maxRows=10&username=woweya");
            // Sostituisci "demo" con il tuo username di GeoNames
            $this->cities = $response->json()['geonames'];
            $this->dispatch('cityIsChanging');
        } catch (\Throwable $th) {
            $this->cities = [];
        }
    }

    public function enableEditingWebsiteURL()
    {
        $this->isEditingWebsiteURL = true;
        $this->updatedWebsiteURL();
    }

    public function enableEditingName()
    {
        $this->isEditingName = true;
        $this->updatedName();
    }

    public function enableEditingBirthday()
    {
        $this->isEditingBirthday = true;
        $this->updatedBirthday();
    }

    public function updatedQuote()
    {

        if ($this->user && $this->quote && Auth::check() && $this->quote != $this->user->quote) {
            $this->user->quote = $this->quote;
            $this->user->save();
            $this->dispatch('quoteChanged');
            $this->isEditingQuote = false;
        }
    }
    public function updatedCity()
    {

        $selectedCity = collect($this->cities)->firstWhere('geonameId', $this->City)['name'];
        $this->City = $selectedCity;
    }
    public function updatedName()
    {
        if ($this->user && $this->name && Auth::check() && $this->name != $this->user->name) {
            $this->user->name = $this->name;
            $this->user->save();
            $this->dispatch('nameChanged');
            $this->isEditingName = false;
        }
    }

    public function updatedBirthday()
    {
        if ($this->user && $this->Birthday && Auth::check() && $this->Birthday != $this->user->birthday) {
            $this->user->birthday = $this->Birthday;
            $this->user->save();
            $this->dispatch('birthdayChanged');
            $this->isEditingBirthday = false;
        }
    }

    //Then on the updatedCountry, fetch the cities
    public function updatedCountry()
    {
        $this->fetchCities($this->Country);
    }


    public function save()
    {
        if ($this->user && $this->Country && Auth::check() && ($this->Country != $this->user->country || $this->City != $this->user->city)) {
            $this->user->country = $this->Country;
            $this->user->city = $this->City;
            $this->user->save();
            $this->isEditingCountry = false;
            $this->dispatch('countryChanged');
        } else {
            return redirect()->back()->with('error', 'You cannot change your country or city.');
        }
    }


    public function updatedAboutMeText()
    {
        if ($this->user) {
            $this->user->about_me_text = $this->AboutMeText;
        }
    }

    public function saveAboutMe()
    {
        if ($this->user && $this->AboutMeText) {
            $this->user->save();
        }
    }

    public function updatedAboutMe()
    {
        if ($this->user) {
            $this->user->about_me = $this->AboutMe;
            $this->user->save();
        }
    }

    public function updatedSocialsInfos()
    {
        if ($this->user) {
            $this->user->social_infos = $this->SocialsInfos;
            $this->user->save();
        }
    }

    public function updatedContactInfos()
    {
        if ($this->user) {
            $this->user->contact_infos = $this->ContactInfos;
            $this->user->save();
        }
    }

    public function updatedPrivateProfile()
    {
        if ($this->user) {
            $this->user->private_profile = $this->PrivateProfile;
            $this->user->save();
        }
    }
}
