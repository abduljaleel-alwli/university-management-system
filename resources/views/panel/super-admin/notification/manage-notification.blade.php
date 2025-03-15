<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Notifications') }}:
        </h2>
    </x-slot>


    @role('super-admin')
        @livewire('send-student-notification')
    @endrole

</x-app-layout>
