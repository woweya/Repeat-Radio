<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class ImageUpload extends Component
{

    use WithFileUploads;

    #[Validate('required|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $photo;

    public $photoPreviewUrl;

    public function render()
    {
        return view('livewire.image-upload');
    }

    public function save(){

        $user = Auth::user();

        $imageName = 'user-'. $user->id . '-profile-picture'. '.' . $this->photo->extension();

        $imagePath = 'images/' . $imageName;

        if($user->image){
            if(file_exists(public_path('storage/' . $user->image->path))){
                unlink(public_path('storage/' . $user->image->path));
            }
            $user->image()->update([
                'path' => $imagePath
            ]);
        }
        else
        {
            $user->image()->create([
                'path' => $imagePath
            ]);

        }


        $this->photo->storeAs('images', $imageName, 'public');

        $this->dispatch('imageUploaded', message: 'Image uploaded successfully');

        $this->removePhoto();
    }

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->photoPreviewUrl = $this->photo->temporaryUrl();
        }
    }

    public function removePhoto()
    {
        $this->photoPreviewUrl = null;
        $this->photo = null;
    }

}
