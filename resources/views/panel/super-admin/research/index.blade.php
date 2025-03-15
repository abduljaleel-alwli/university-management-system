<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Researche List') }}
        </h2>
    </x-slot>

    @livewire('researches')

</x-app-layout>
