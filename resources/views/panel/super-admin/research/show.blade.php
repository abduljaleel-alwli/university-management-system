<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Researche') }}
        </h2>
    </x-slot>

    @livewire('show-research',['research_id' => $research_id])

</x-app-layout>
