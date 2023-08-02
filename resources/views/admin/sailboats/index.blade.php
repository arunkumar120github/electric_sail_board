<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Sailboats') }}
            </h2>
            <x-jet-link href="{{ route('sailboats.create') }}">
                {{ __('New Sailboat') }}
            </x-jet-link>
        </div>
    </x-slot>
    @livewire('sailboat-filter-form')
</x-app-layout>