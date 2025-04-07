<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Specializations') }}
        </h2>
    </x-slot>

    <div class="px-3">
        <livewire:specialization-list />
    </div>

</x-app-layout>
