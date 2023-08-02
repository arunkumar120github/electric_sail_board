<div class="mt-5 md:mt-0 md:col-span-2">
    <form wire:submit.prevent="{{ $this->sailboat ? 'updateSailboat' : 'createSailboat' }}">
        <div class="px-4 py-5 bg-white sm:p-6 sm:rounded-tl-md sm:rounded-tr-md">
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="user_id" value="{{ __('Member') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="user_id">
                            <option value="null" disabled>{{ __('Select Member') }}</option>
                            @if(count($this->users) > 0)
                                @foreach($this->users as $user)
                                    <option value="{{ $user->id }}" wire:key="member-{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-jet-input-error for="user_id" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" type="text" class="mt-1 block w-full" placeholder="Sailboat Title" wire:model.defer="title" />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="year" value="{{ __('Year') }}" />
                        <x-jet-input id="year" type="text" class="mt-1 block w-full" placeholder="Year" wire:model.defer="year" />
                        <x-jet-input-error for="year" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="manufacturer" value="{{ __('Manufacturer') }}" />
                        <x-jet-input id="manufacturer" type="text" class="mt-1 block w-full" placeholder="Manufacturer" wire:model.defer="manufacturer" />
                        <x-jet-input-error for="manufacturer" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="model" value="{{ __('Model') }}" />
                        <x-jet-input id="model" type="text" class="mt-1 block w-full" placeholder="Model" wire:model.defer="model" />
                        <x-jet-input-error for="model" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="displacement" value="{{ __('Displacement') }}" />
                        <x-jet-input id="displacement" type="text" class="mt-1 block w-full" placeholder="Displacement" wire:model.defer="displacement" />
                        <x-jet-input-error for="displacement" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="status" value="{{ __('Status') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="status">
                            <option value="Complete" wire:key="status-complete">{{ __('Complete') }}</option>
                            <option value="In Process" wire:key="status-in-process">{{ __('In Process') }}</option>
                        </select>
                        <x-jet-input-error for="status" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="loa" value="{{ __('LOA') }}" />
                        <x-jet-input id="loa" type="text" class="mt-1 block w-full" placeholder="LOA" wire:model.defer="loa" />
                        <x-jet-input-error for="loa" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="motor" value="{{ __('Motor') }}" />
                        <x-jet-input id="motor" type="text" class="mt-1 block w-full" placeholder="Motor" wire:model.defer="motor" />
                        <x-jet-input-error for="motor" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="battery_brand" value="{{ __('Battery Brand') }}" />
                        <x-jet-input id="battery_brand" type="text" class="mt-1 block w-full" placeholder="Battery Brand" wire:model.defer="battery_brand" />
                        <x-jet-input-error for="battery_brand" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="battery_type" value="{{ __('Battery Type') }}" />
                        <x-jet-input id="battery_type" type="text" class="mt-1 block w-full" placeholder="Battery Type" wire:model.defer="battery_type" />
                        <x-jet-input-error for="battery_type" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="solar_panel" value="{{ __('Solar Panel') }}" />
                        <x-jet-input id="solar_panel" type="text" class="mt-1 block w-full" placeholder="Solar Panel" wire:model.defer="solar_panel" />
                        <x-jet-input-error for="solar_panel" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="wind_generator" value="{{ __('Wind Generator') }}" />
                        <x-jet-input id="wind_generator" type="text" class="mt-1 block w-full" placeholder="Wind Generator" wire:model.defer="wind_generator" />
                        <x-jet-input-error for="wind_generator" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="genset" value="{{ __('Genset') }}" />
                        <x-jet-input id="genset" type="text" class="mt-1 block w-full" placeholder="Genset" wire:model.defer="genset" />
                        <x-jet-input-error for="genset" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="controller" value="{{ __('Controller') }}" />
                        <x-jet-input id="controller" type="text" class="mt-1 block w-full" placeholder="Controller" wire:model.defer="controller" />
                        <x-jet-input-error for="controller" class="mt-2" />
                    </div>
                </div>
                <div class="w-1/2 mb-4">
                    <div class="px-4">
                        <x-jet-label for="sailing_type" value="{{ __('Type of Sailing') }}" />
                        <x-jet-input id="sailing_type" type="text" class="mt-1 block w-full" placeholder="Type of Sailing" wire:model.defer="sailing_type" />
                        <x-jet-input-error for="sailing_type" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="px-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <livewire:text-editor :value="$this->description">
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Frequently Asked Questions') }}</h3>
                        <livewire:sailboat-faq :faqs="$this->faqs">
                        <x-jet-input-error for="faqs" class="mt-2" />
                        <x-jet-input-error for="faqs.*" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Upload Images') }}</h3>
                        <livewire:sailboat-media :uploaded="$this->images">
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Upload Videos') }}</h3>
                        <livewire:sailboat-video :uploaded="$this->videos">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-3 bg-gray-100 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
            <x-jet-button>
                {{ __('Save Details') }}
            </x-jet-button>
        </div>
    </form>
</div>
