@php
$settings = app_settings();
@endphp


@if ($settings->site_logo)
    <img src="{{ asset($settings->site_logo) }}"
        class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
@else
    <img src="{{ asset('assets/img/logo-ct.png') }}"
        class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
@endif
