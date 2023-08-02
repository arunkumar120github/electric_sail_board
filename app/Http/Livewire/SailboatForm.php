<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\FileUploadConfiguration;
use App\Http\Livewire\TextEditor;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Sailboat;
use App\Models\SailboatFaq as FAQ;
use App\Models\SailboatVideo as BoatVideo;
use App\Models\SailboatPhoto;

class SailboatForm extends Component
{
    public $defaults = [
        ['question' => null, 'answer' => null]
    ];

    public $sailboat;
    public $users;
    public $user_id;
    public $title;
    public $year;
    public $manufacturer;
    public $model;
    public $displacement;
    public $status;
    public $loa;
    public $motor;
    public $battery_brand;
    public $battery_type;
    public $solar_panel;
    public $wind_generator;
    public $genset;
    public $controller;
    public $sailing_type;
    public $description;
    public $faqs;
    public $images;
    public $videos;

    protected $rules = [
        'user_id' => 'required|numeric',
        'title' => 'required|string|max:255',
        'year' => 'required|numeric',
        'manufacturer' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'displacement' => 'required|string|max:255',
        'status' => 'required|string|in:Complete,In Process',
        'loa' => 'required|string|max:255',
        'motor' => 'required|string|max:255',
        'battery_brand' => 'required|string|max:255',
        'battery_type' => 'required|string|max:255',
        'solar_panel' => 'required|string|max:255',
        'wind_generator' => 'required|string|max:255',
        'genset' => 'required|string|max:255',
        'controller' => 'required|string|max:255',
        'sailing_type' => 'required|string|max:255',
        'description' => 'required',
        'faqs' => 'required|array',
        'faqs.*.question' => 'required',
        'faqs.*.answer' => 'required',
    ];

    protected $messages = [
        'faqs.*.question.required' => 'Empty questions are not accepted',
        'faqs.*.answer.required' => 'Empty answers are not accepted',
    ];

    protected $validationAttributes = [
        'user_id' => 'member',
        'sailing_type' => 'type of sailing',
    ];

    public $listeners = [
        TextEditor::EVENT_VALUE_UPDATED,
        SailboatFaq::EVENT_FAQ_UPDATED,
        SailboatMedia::EVENT_IMAGES_UPLOADED,
        SailboatVideo::EVENT_VIDEOS_UPLOADED,
    ];

    public function mount($sailboat = null)
    {
        $this->users = User::where('role', 'Member')->get();
        if ($sailboat) {
            $this->user_id = $sailboat->user_id;
            $this->title = $sailboat->title;
            $this->year = $sailboat->year;
            $this->manufacturer = $sailboat->manufacturer;
            $this->model = $sailboat->model;
            $this->displacement = $sailboat->displacement;
            $this->status = $sailboat->status;
            $this->loa = $sailboat->loa;
            $this->motor = $sailboat->motor;
            $this->battery_brand = $sailboat->battery_brand;
            $this->battery_type = $sailboat->battery_type;
            $this->solar_panel = $sailboat->solar_panel;
            $this->wind_generator = $sailboat->wind_generator;
            $this->genset = $sailboat->genset;
            $this->controller = $sailboat->controller;
            $this->sailing_type = $sailboat->sailing_type;
            $this->description = $sailboat->description;
            $this->faqs = $sailboat->faqs->toArray();
            $this->images = $sailboat->photos->toArray();
            $this->videos = $sailboat->videos->toArray();
        } else {
            $this->status = 'Complete';
            $this->faqs = $this->defaults;
            $this->images = [];
            $this->videos = [];
        }
    }

    public function render()
    {
        return view('livewire.sailboat-form');
    }

    public function createSailboat()
    {
        $this->validate();

        $sailboat = Sailboat::create([
            'user_id' => $this->user_id,
            'title' => $this->title,
            'year' => $this->year,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'displacement' => $this->displacement,
            'status' => $this->status,
            'loa' => $this->loa,
            'motor' => $this->motor,
            'battery_brand' => $this->battery_brand,
            'battery_type' => $this->battery_type,
            'solar_panel' => $this->solar_panel,
            'wind_generator' => $this->wind_generator,
            'genset' => $this->genset,
            'controller' => $this->controller,
            'sailing_type' => $this->sailing_type,
            'description' => $this->description,
        ]);

        if (count($this->faqs) > 0) {
            foreach ($this->faqs as $faq) {
                FAQ::create([
                    'sailboat_id' => $sailboat->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }

        if (count($this->images) > 0) {
            foreach ($this->images as $filename) {
                if (!is_array($filename)) {
                    $directory = FileUploadConfiguration::directory();
                    Storage::makeDirectory('sailboat-images');
                    if (Storage::move("{$directory}/{$filename}", "sailboat-images/{$filename}")) {
                        SailboatPhoto::create([
                            'sailboat_id' => $sailboat->id,
                            'image_path' => "sailboat-images/{$filename}"
                        ]);
                    }
                }
            }
        }

        if (count($this->videos) > 0) {
            foreach ($this->videos as $path) {
                if (!is_array($path)) {
                    Storage::makeDirectory('sailboat-videos');
                    $newPath = str_replace('sailboat-tmp-videos', 'sailboat-videos', $path);
                    if (Storage::move($path, $newPath)) {
                        BoatVideo::create([
                            'sailboat_id' => $sailboat->id,
                            'video_path' => $newPath,
                        ]);
                    }
                }

            }
        }

        session()->flash('flash.banner', 'Sailboat successfully created.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('sailboats.index');
    }

    public function editorValueUpdated($value)
    {
        $this->description = $value;
    }

    public function faqUpdated($faqs)
    {
        $this->faqs = $faqs;
    }

    public function imagesUploaded($images)
    {
        $this->images = $images;
    }

    public function videosUploaded($videos)
    {
        $this->videos = $videos;
    }

    public function updateSailboat()
    {
        $this->validate();

        $this->sailboat->update([
            'user_id' => $this->user_id,
            'title' => $this->title,
            'year' => $this->year,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'displacement' => $this->displacement,
            'status' => $this->status,
            'loa' => $this->loa,
            'motor' => $this->motor,
            'battery_brand' => $this->battery_brand,
            'battery_type' => $this->battery_type,
            'solar_panel' => $this->solar_panel,
            'wind_generator' => $this->wind_generator,
            'genset' => $this->genset,
            'controller' => $this->controller,
            'sailing_type' => $this->sailing_type,
            'description' => $this->description,
        ]);

        FAQ::where('sailboat_id', $this->sailboat->id)->delete();
        if (count($this->faqs) > 0) {
            foreach ($this->faqs as $faq) {
                FAQ::create([
                    'sailboat_id' => $this->sailboat->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
            }
        }

        if (count($this->images) > 0) {
            foreach ($this->images as $filename) {
                if (!is_array($filename)) {
                    $directory = FileUploadConfiguration::directory();
                    Storage::makeDirectory('sailboat-images');
                    if (Storage::move("{$directory}/{$filename}", "sailboat-images/{$filename}")) {
                        SailboatPhoto::create([
                            'sailboat_id' => $this->sailboat->id,
                            'image_path' => "sailboat-images/{$filename}"
                        ]);
                    }
                }
            }
        }

        if (count($this->videos) > 0) {
            foreach ($this->videos as $path) {
                if (!is_array($path)) {
                    Storage::makeDirectory('sailboat-videos');
                    $newPath = str_replace('sailboat-tmp-videos', 'sailboat-videos', $path);
                    if (Storage::move($path, $newPath)) {
                        BoatVideo::create([
                            'sailboat_id' => $this->sailboat->id,
                            'video_path' => $newPath,
                        ]);
                    }
                }

            }
        }

        session()->flash('flash.banner', 'Sailboat successfully updated.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('sailboats.index');
    }
}
