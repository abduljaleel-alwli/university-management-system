<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Graduation Steps') }}
        </h2>
    </x-slot>

    @livewire('post-graduation-steps-index')

</x-app-layout>
