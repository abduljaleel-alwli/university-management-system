@php
    use Diglactic\Breadcrumbs\Breadcrumbs;
@endphp

<!-- Navbar -->
<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start sticky top-[1%]
             backdrop-saturate-[200%] backdrop-blur-[30px] bg-[hsla(0,0%,100%,0.8)] shadow-blur z-110
             nav-box"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                {{ Breadcrumbs::render() }}
            </div>

            <h6 class="mb-0 font-bold capitalize">
                <!-- Page Heading -->
                @if (isset($header))
                    {{ $header }}
                @endif
            </h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

            <div class="flex items-center md:ml-auto md:pr-4">
                {{-- Input Box Here --}}
                @if (isRoute('admin.students.index') ||
                        isRoute('super-admin.students.index') ||
                        isRoute('admin.departments.show') ||
                        isRoute('super-admin.departments.show') ||
                        isRoute('super-admin.notifications.index') ||
                        isRoute('admin.send-emails.index') ||
                        isRoute('super-admin.reports.index') ||
                        isRoute('admin.researches.create'))
                    <div class="tips-box nav-tooltips bg-white border border-gray-100 rounded-xl p-4">
                        <x-status-circle color="bg-white tip-circle" label="Active" />
                        <x-status-circle color="bg-green-100 tip-circle" label="Graduate" />
                        <x-status-circle color="bg-red-100 tip-circle" label="Fail" />
                        <x-status-circle color="bg-yellow-100 tip-circle" label="Suspended" />
                        <x-status-circle color="bg-orange-500 is-close-to-end tip-circle"
                            label="The student study period ends after 3 months." />
                        <x-status-circle color="bg-gradient-pending from-gray-100 to-gray-100 tip-circle"
                            label="Pending Review" />
                        <x-status-circle color="bg-gradient-pending-2 from-gray-100 to-gray-100 tip-circle"
                            label="Post-Graduation discussion Pending Review" />
                    </div>
                @endif
            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

                <div class="navigation-btns">
                    @auth
                        <!-- Teams Dropdown -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->currentTeam->name }}

                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-dropdown-link
                                                href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-dropdown-link>

                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-dropdown-link>
                                            @endcan

                                            <!-- Team Switcher -->
                                            @if (Auth::user()->allTeams()->count() > 1)
                                                <div class="border-t border-gray-200"></div>

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-switchable-team :team="$team" />
                                                @endforeach
                                            @endif
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif

                        <!-- Notifications -->
                        @livewire('admin-notifications')

                    @endauth

                    <!-- Language Switcher Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center px-4 py-2 text-gray-700 rounded-lg rounded-2xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 ease-in-out">
                                    <svg width="25px" height="25px" viewBox="0 0 24.00 24.00" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#09244B"
                                        stroke-width="0.00024000000000000003">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M20.58 19.37L17.59 11.01C17.38 10.46 16.91 10.12 16.37 10.12C15.83 10.12 15.37 10.46 15.14 11.03L12.16 19.37C12.02 19.76 12.22 20.19 12.61 20.33C13 20.47 13.43 20.27 13.57 19.88L14.19 18.15H18.54L19.16 19.88C19.27 20.19 19.56 20.38 19.87 20.38C19.95 20.38 20.04 20.37 20.12 20.34C20.51 20.2 20.71 19.77 20.57 19.38L20.58 19.37ZM14.74 16.64L16.38 12.05L18.02 16.64H14.74ZM12.19 7.85C9.92999 11.42 7.89 13.58 5.41 15.02C5.29 15.09 5.16 15.12 5.04 15.12C4.78 15.12 4.53 14.99 4.39 14.75C4.18 14.39 4.3 13.93 4.66 13.73C6.75999 12.51 8.48 10.76 10.41 7.86H4.12C3.71 7.86 3.37 7.52 3.37 7.11C3.37 6.7 3.71 6.36 4.12 6.36H7.87V4.38C7.87 3.97 8.21 3.63 8.62 3.63C9.02999 3.63 9.37 3.97 9.37 4.38V6.36H13.12C13.53 6.36 13.87 6.7 13.87 7.11C13.87 7.52 13.53 7.86 13.12 7.86H12.18L12.19 7.85ZM12.23 15.12C12.1 15.12 11.97 15.09 11.85 15.02C11.2 14.64 10.57 14.22 9.97999 13.78C9.64999 13.53 9.58 13.06 9.83 12.73C10.08 12.4 10.55 12.33 10.88 12.58C11.42 12.99 12.01 13.37 12.61 13.72C12.97 13.93 13.09 14.39 12.88 14.75C12.74 14.99 12.49 15.12 12.23 15.12Z"
                                                fill="#09244B"></path>
                                        </g>
                                    </svg>
                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Language Options -->
                                <div class="block px-4 py-2 text-sm text-gray-500">
                                    {{ __('Change Language') }}
                                </div>

                                <x-dropdown-link href="{{ route('lang.switch', 'en') }}"
                                    class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out
                    {{ app()->getLocale() === 'en' ? 'bg-blue-50 text-blue-700 font-medium' : '' }}">
                                    <span class="ms-2">{{ __('English') }}</span>
                                </x-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <x-dropdown-link href="{{ route('lang.switch', 'ar') }}"
                                    class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out
                    {{ app()->getLocale() === 'ar' ? 'bg-blue-50 text-blue-700 font-medium' : '' }}">
                                    <span class="ms-2">{{ __('Arabic') }}</span>
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    @auth
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="size-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}

                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>

                @auth
                    <!-- Burger menu -->
                    <li class="flex items-center pl-4 xl:hidden">
                        <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
                            sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            </div>
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidenavTrigger = document.querySelector("[sidenav-trigger]");
        const sidenavClose = document.querySelector("[sidenav-close]");
        const sidebar = document.querySelector(".sidebar-box");
        const overlay = document.getElementById("overlay");

        if (sidenavTrigger && sidebar && overlay) {
            sidenavTrigger.addEventListener("click", function() {
                sidebar.classList.toggle("isOpen");
                overlay.classList.toggle("hidden");
            });
        }

        if (sidenavClose && sidebar && overlay) {
            sidenavClose.addEventListener("click", function() {
                sidebar.classList.remove("isOpen");
                overlay.classList.add("hidden");
            });
        }

        // إغلاق القائمة عند النقر خارجها
        overlay.addEventListener("click", function() {
            sidebar.classList.remove("isOpen");
            overlay.classList.add("hidden");
        });
    });
</script>
