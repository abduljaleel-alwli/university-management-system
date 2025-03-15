<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create report') }}
        </h2>
    </x-slot>

    @livewire('student-reports')
</x-app-layout>
