<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Settings') }}
        </h2>
    </x-slot>

    @livewire('settings-form')

</x-app-layout>
