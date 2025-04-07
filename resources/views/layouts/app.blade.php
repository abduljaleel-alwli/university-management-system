@php
$settings = app_settings();
@endphp

<!DOCTYPE html>
@if (isRtl())
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->site_name ? $settings->site_name : 'University System' }} | {{ isset($header) ? strip_tags($header) : '' }} </title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset($settings->favicon) }}" />

    @if (isRtl())
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @else
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @endif

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- FontAwesome -->
    {{-- <script src="https://kit.fontawesome.com/639743d220.js" crossorigin="anonymous"></script> --}}

    <!-- Main Styling -->
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/perfect-scrollbar.css') }}" rel="stylesheet" /> --}}

    <!-- Style CSS -->
    <style>
        :root {
            --primary-color: {{ $settings->primary_color }};
            --secondary-color: {{ $settings->secondary_color }};
            --accent-color: {{ $settings->accent_color }};
            --background-color: {{ $settings->background_color }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body
    class=" {{ isRtl() ? 'rtl' : '' }} antialiased m-0 text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">

    <!-- Sidebar -->
    @include('components.sidebar')

    <main id="min-app"
        class="ease-soft-in-out {{ isRtl() ? 'xl:mr-68.5' : 'xl:ml-68.5' }} relative h-full max-h-screen rounded-xl transition-all duration-200">

        <!-- Navigation Menu -->
        @include('components.navigation-menu')

        <x-banner />

        <div class="min-content min-h-screen">
            @if (session('success') || session('error') || session()->has('message'))
                <div id="notification"
                    class="fixed bottom border border-gray-300 right-5 max-w-sm w-full bg-white shadow-soft-xl rounded-2xl pointer-events-auto ring-1 ring-black ring-opacity-5 transition-transform transform translate-y-[100%] opacity-0 duration-300">
                    <div class="p-4 flex items-start">
                        <!-- أيقونة الإشعار -->
                        <div class="flex-shrink-0">
                            @if (session('success'))
                                <svg width="20px" height="20px" viewBox="0 0 1024 1024" class="icon" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                    style="scale: 1.3; margin: 0 7px; margin-top: -9px;">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M905.92 237.76a32 32 0 0 0-52.48 36.48A416 416 0 1 1 96 512a418.56 418.56 0 0 1 297.28-398.72 32 32 0 1 0-18.24-61.44A480 480 0 1 0 992 512a477.12 477.12 0 0 0-86.08-274.24z"
                                            fill="#1eff00"></path>
                                        <path
                                            d="M630.72 113.28A413.76 413.76 0 0 1 768 185.28a32 32 0 0 0 39.68-50.24 476.8 476.8 0 0 0-160-83.2 32 32 0 0 0-18.24 61.44zM489.28 86.72a36.8 36.8 0 0 0 10.56 6.72 30.08 30.08 0 0 0 24.32 0 37.12 37.12 0 0 0 10.56-6.72A32 32 0 0 0 544 64a33.6 33.6 0 0 0-9.28-22.72A32 32 0 0 0 505.6 32a20.8 20.8 0 0 0-5.76 1.92 23.68 23.68 0 0 0-5.76 2.88l-4.8 3.84a32 32 0 0 0-6.72 10.56A32 32 0 0 0 480 64a32 32 0 0 0 2.56 12.16 37.12 37.12 0 0 0 6.72 10.56zM230.08 467.84a36.48 36.48 0 0 0 0 51.84L413.12 704a36.48 36.48 0 0 0 51.84 0l328.96-330.56A36.48 36.48 0 0 0 742.08 320l-303.36 303.36-156.8-155.52a36.8 36.8 0 0 0-51.84 0z"
                                            fill="#1eff00"></path>
                                    </g>
                                </svg>
                            @elseif (session('error'))
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    style="margin: 0 7px; margin-top: -9px; scale: 1.3;">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g id="style=doutone">
                                            <g id="error-box">
                                                <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.25 8C1.25 4.27208 4.27208 1.25 8 1.25H16C19.7279 1.25 22.75 4.27208 22.75 8V16C22.75 19.7279 19.7279 22.75 16 22.75H8C4.27208 22.75 1.25 19.7279 1.25 16V8ZM8 2.75C5.10051 2.75 2.75 5.10051 2.75 8V16C2.75 18.8995 5.10051 21.25 8 21.25H16C18.8995 21.25 21.25 18.8995 21.25 16V8C21.25 5.10051 18.8995 2.75 16 2.75H8Z"
                                                    fill="#ff7575"></path>
                                                <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.46967 8.46967C8.76257 8.17678 9.23744 8.17678 9.53033 8.46967L15.5303 14.4697C15.8232 14.7626 15.8232 15.2374 15.5303 15.5303C15.2374 15.8232 14.7625 15.8232 14.4696 15.5303L8.46967 9.53033C8.17678 9.23743 8.17678 8.76256 8.46967 8.46967Z"
                                                    fill="#ff7575"></path>
                                                <path id="vector (Stroke)_3" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.5303 8.46967C15.8232 8.76257 15.8232 9.23744 15.5303 9.53033L9.53033 15.5303C9.23743 15.8232 8.76256 15.8232 8.46967 15.5303C8.17678 15.2374 8.17678 14.7625 8.46967 14.4696L14.4697 8.46967C14.7626 8.17678 15.2374 8.17678 15.5303 8.46967Z"
                                                    fill="#ff7575"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            @else
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="margin-top: -9px; scale: 1.3;">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M3 13V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.0799 18 6.2 18H16.2446C16.5263 18 16.6672 18 16.8052 18.0193C16.9277 18.0365 17.0484 18.065 17.1656 18.1044C17.2977 18.1488 17.4237 18.2118 17.6757 18.3378L21 20V7.2C21 6.0799 21 5.51984 20.782 5.09202C20.5903 4.71569 20.2843 4.40973 19.908 4.21799C19.4802 4 18.9201 4 17.8 4H13M8.12132 3.87868C9.29289 5.05025 9.29289 6.94975 8.12132 8.12132C6.94975 9.29289 5.05025 9.29289 3.87868 8.12132C2.70711 6.94975 2.70711 5.05025 3.87868 3.87868C5.05025 2.70711 6.94975 2.70711 8.12132 3.87868Z"
                                            stroke="#09244B" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            @endif
                        </div>
                        <!-- نص الإشعار -->
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                {{ session('success') ?? (session('error') ?? session('message')) }}
                            </p>
                        </div>
                        <!-- زر الإغلاق -->
                        <div class="flex-shrink-0 flex">
                            <button id="closeBtn" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="py-12 max-w-7xl mx-auto sm:px-5 lg:px-3">
                {{ $slot }}
            </main>
        </div>
    </main>

    @stack('modals')

    @livewireScripts
    @stack('scripts')
    @yield('footer-script')

    @if (session('success') || session('error') || session()->has('message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const notification = document.getElementById("notification");
                const closeBtn = document.getElementById("closeBtn");

                // إظهار الإشعار مع حركة صعود من الأسفل
                setTimeout(() => {
                    notification.classList.remove("translate-y-[100%]", "opacity-0");
                    notification.classList.add("open-notification", "opacity-100");
                }, 300);

                // زر الإغلاق مع حركة نزول عند الإخفاء
                closeBtn.addEventListener("click", () => {
                    notification.classList.remove("open-notification", "opacity-100");
                    notification.classList.add("close-notification", "opacity-0");
                    setTimeout(() => {
                        notification.remove(); // إزالة العنصر بعد انتهاء الحركة
                    }, 300);
                });

                // إغلاق الإشعار تلقائيًا بعد 5 ثوانٍ
                setTimeout(() => {
                    notification.classList.remove("open-notification", "opacity-100");
                    notification.classList.add("close-notification", "opacity-0");
                    setTimeout(() => {
                        notification.remove();
                    }, 600);
                }, 7000);
            });
        </script>
    @endif
</body>

</html>
