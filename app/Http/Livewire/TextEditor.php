<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TextEditor extends Component
{
    const EVENT_VALUE_UPDATED = 'editorValueUpdated';

    public $value;
    public $editorId;

    public function mount($value = '')
    {
        $this->value = $value;
        $this->editorId = 'editor-' . uniqid();
    }

    public function updatedValue($value)
    {
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function render()
    {
        return view('livewire.text-editor');
    }
}
