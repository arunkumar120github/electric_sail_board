<div>
    @if(count($this->faqs) > 0)
        @foreach($this->faqs as $key => $faq)
        <div class="bg-gray-200 px-4 py-4 mb-4" wire:key="{{$key}}">
            <div class="mb-4">
                <x-jet-label for="question-{{$key}}" value="{{ __('Question') }}" />
                <x-jet-input id="question-{{$key}}" type="text" class="mt-1 block w-full" placeholder="Question" wire:model="faqs.{{$key}}.question" />
                <x-jet-input-error for="faqs.{{$key}}.question" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label for="answer-{{$key}}" value="{{ __('Answer') }}" />
                <x-jet-input id="answer-{{$key}}" type="text" class="mt-1 block w-full" placeholder="Answer" wire:model="faqs.{{$key}}.answer" />
                <x-jet-input-error for="faqs.{{$key}}.answer" class="mt-2" />
            </div>
            <div class="flex justify-end">
                <x-jet-danger-button wire:click.prevent="removeQuestion({{$key}})">
                    {{ __('Remove') }}
                </x-jet-danger-button>
            </div>
        </div>
        @endforeach
    @endif
    <div class="mt-2">
        <x-jet-button type="button" wire:click.prevent="addQuestion">
            {{ __('Add Question') }}
        </x-jet-button>
    </div>
</div>
