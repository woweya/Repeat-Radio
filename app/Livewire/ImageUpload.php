<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;

class ImageUpload extends Component
{
    use WithFileUploads;

    #[Validate('required|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $photo;

    public $previewUrl;
    public $cropX;
    public $cropY;
    public $cropWidth;
    public $cropHeight;
    public $temporaryPhotoPath;

    public function render()
    {
        return view('livewire.image-upload');
    }


    // Livewire Events from JavaScript of image-upload.blade.php
    #[On('setCropValues')]
    public function setCropValues($x, $y, $width, $height)
    {
        $this->cropX = $x;
        $this->cropY = $y;
        $this->cropWidth = $width;
        $this->cropHeight = $height;

    }


    #[On('save')]
    public function save()
    {
        if (!$this->temporaryPhotoPath) {
            return; // No photo to save
        }

        $user = Auth::user();


        $imageName = 'user-' . $user->id . '-profile-picture.' . pathinfo($this->temporaryPhotoPath, PATHINFO_EXTENSION);
        $imagePath = 'images/' . $imageName;

        // Create a new image manager instance
        $imageManager = new ImageManager();


        // Load the original image
        $image = $imageManager->make($this->temporaryPhotoPath);


        // Check if crop values are set before cropping
        if ($this->cropWidth && $this->cropHeight && $this->cropX !== null && $this->cropY !== null) {

            // Convert crop values to integers
            $this->cropX = intval($this->cropX);
            $this->cropY = intval($this->cropY);
            $this->cropWidth = intval($this->cropWidth);
            $this->cropHeight = intval($this->cropHeight);

            // Crop the image
            $image->crop($this->cropWidth, $this->cropHeight, $this->cropX, $this->cropY);
        }


        // Store the cropped image in storage
        $image->save(public_path('storage/' . $imagePath));

        if ($user->image) {
            if (file_exists(public_path('storage/' . $user->image->path))) {
                unlink(public_path('storage/' . $user->image->path));
            }
            $user->image()->update(['path' => $imagePath]);
        } else {
            $user->image()->create(['path' => $imagePath]);
        }

        $this->dispatch('imageUploaded', message: 'Image uploaded successfully');

        $this->removePhoto();
    }

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->previewUrl = $this->photo->temporaryUrl();
            $this->temporaryPhotoPath = $this->photo->getRealPath(); // Save the temporary path
            $this->dispatch('previewImage');
        }
    }

    public function removePhoto()
    {
        $this->previewUrl = null;
        $this->photo = null;
        $this->temporaryPhotoPath = null;
    }
}
