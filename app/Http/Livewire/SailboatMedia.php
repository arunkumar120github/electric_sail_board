<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\SailboatPhoto;

class SailboatMedia extends Component
{
    use WithFileUploads;

    const EVENT_IMAGES_UPLOADED = 'imagesUploaded';

    public $images = [];
    public $uploads = [];
    public $uploaded = [];

    public function finishUpload($name, $tmpPath, $isMultiple) 
    {
        $this->cleanupOldUploads();
 
        $files = collect($tmpPath)->map(function ($i) {
            return TemporaryUploadedFile::createFromLivewire($i);
        })->toArray();
        $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());
 
        $files = array_merge($this->getPropertyValue($name), $files);
        $this->syncInput($name, $files);
    }

    public function mount($uploaded)
    {
        $this->uploaded = $uploaded;
    }

    public function render()
    {
        return view('livewire.sailboat-media');
    }

    public function updatedImages()
    {
        $rules = ['images.*' => 'image|mimes:jpg,jpeg,png|max:20480'];
        $messages = [
            'images.*.image' => 'Only images are allowed to upload',
            'images.*.mimes' => 'Acceptable image formats: JPG, JPEG, PNG',
            'images.*.max' => 'Max acceptable file size in 20MB',
        ];
        $this->validate($rules, $messages);
    }

    public function updateForm()
    {
        $errors = $this->getErrorBag();
        $this->uploads = [];
        foreach ($this->images as $index => $image) {
            if ($errors->has("images.{$index}")) {
                unset($this->images[$index]);
            } else {
                $this->uploads[] = $image->getFilename();
            }
        }

        $this->emit(self::EVENT_IMAGES_UPLOADED, $this->uploads);
    }

    public function removeSailboatPhoto($id)
    {
        $photo = SailboatPhoto::findOrFail($id);
        Storage::disk(config('filesystems.default'))->delete($photo->image_path);
        $sailboat = $photo->sailboat;
        $photo->delete();
        $this->uploaded = $sailboat->photos->toArray();
    }
}
