<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Send Email') }}
        </h2>
    </x-slot>

    @livewire('send-student-email')

</x-app-layout>
