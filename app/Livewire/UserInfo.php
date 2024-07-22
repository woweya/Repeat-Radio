<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\View\Components\layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

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
    public $isEditingBirthday = false;
    public $PrivateProfile = false;

    public $WebsiteURL = '';

    #[Validate]
    public $name = '';
    public $AboutMeText = '';
    public $Birthday;

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
        }
    }

    public function rules(){
        return [
            'name' => 'required|min:3',
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


    public function updatedWebsiteURL(){
        if($this->user)
        {
            $this->user->website_url = $this->WebsiteURL;
            $this->user->save();
            $this->isEditingWebsiteURL = false;
        }
    }


    public function enableEditingWebsiteURL()
    {
        $this->isEditingWebsiteURL = true;
    }

    public function enableEditingName(){
        $this->isEditingName = true;
    }

    public function enableEditingBirthday(){
        $this->isEditingBirthday = true;
    }

    public function updatedName(){
        if ($this->user && $this->name && Auth::check() && $this->name != $this->user->name) {
            $this->user->name = $this->name;
            $this->user->save();
            $this->dispatch('nameChanged');
            $this->isEditingName = false;
        }
    }

    public function updatedBirthday(){
        if($this->user && $this->Birthday && Auth::check() && $this->Birthday != $this->user->birthday){
            $this->user->birthday = $this->Birthday;
            $this->user->save();
            $this->dispatch('birthdayChanged');
            $this->isEditingBirthday = false;
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
