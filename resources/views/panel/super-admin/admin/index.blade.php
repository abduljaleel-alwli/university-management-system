<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Admins') }}
        </h2>
    </x-slot>

    @livewire('super-admin-users')
    
</x-app-layout>
