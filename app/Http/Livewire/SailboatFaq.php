<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SailboatFaq extends Component
{
    const EVENT_FAQ_UPDATED = 'faqUpdated';

    public $faqs;
    public $defaults = [
        ['question' => null, 'answer' => null]
    ];

    public function mount($faqs)
    {
        $this->faqs = $faqs;
    }

    public function updatedFaqs($faqs)
    {
        $this->emit(self::EVENT_FAQ_UPDATED, $this->faqs);
    }

    public function render()
    {
        return view('livewire.sailboat-faq');
    }

    public function addQuestion()
    {
        array_push($this->faqs, $this->defaults);
        $this->emit(self::EVENT_FAQ_UPDATED, $this->faqs);
    }

    public function removeQuestion($key)
    {
        unset($this->faqs[$key]);
        $this->emit(self::EVENT_FAQ_UPDATED, $this->faqs);
    }
}
