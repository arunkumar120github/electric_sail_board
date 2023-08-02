<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Sailboat') }}
            </h2>
            <x-jet-danger-link href="{{ route('users.index') }}">
                {{ __('Cancel') }}
            </x-jet-danger-link>
        </div>
    </x-slot>

    <div class="container py-12 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('user-form', ['user' => $user ,'profile' => $profile])
            </div>
        </div>
    </div>
</x-app-layout>