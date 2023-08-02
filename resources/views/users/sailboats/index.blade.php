<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users Details') }}
            </h2>
            <x-jet-link href="{{ route('users.create')  }}">
                {{ __('New User') }}
            </x-jet-link>
        </div>
    </x-slot>
    @livewire('user-details-page')   
</x-app-layout>