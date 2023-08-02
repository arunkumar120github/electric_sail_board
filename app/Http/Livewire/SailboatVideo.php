<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\SailboatVideo as BoatVideo;

class SailboatVideo extends Component
{
    const EVENT_VIDEOS_UPLOADED = 'videosUploaded';
    
    public $uploadError;
    public $videos = [];
    public $uploaded = [];

    public function render()
    {
        return view('livewire.sailboat-video');
    }

    public function mount($uploaded)
    {
        $this->uploaded = $uploaded;
    }

    public function addVideo($path)
    {
        array_push($this->videos, $path);
        $this->emit(self::EVENT_VIDEOS_UPLOADED, $this->videos);
    }
    
    public function removeVideo($key)
    {
        $path = $this->videos[$key];
        Storage::disk(config('filesystems.default'))->delete($path);
        unset($this->videos[$key]);
        $this->emit(self::EVENT_VIDEOS_UPLOADED, $this->videos);
    }

    public function removeSailboatVideo($id)
    {
        $video = BoatVideo::findOrFail($id);
        Storage::disk(config('filesystems.default'))->delete($video->video_path);
        $sailboat = $video->sailboat;
        $video->delete();
        $this->uploaded = $sailboat->videos->toArray();
    }
}
