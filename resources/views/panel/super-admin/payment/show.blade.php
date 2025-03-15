<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    @livewire('payment-show', ['paymentId' => $payment_id])

</x-app-layout>
