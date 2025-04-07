<div class="px-6">
    <div class="bg-white rounded-xl shadow-soft-xl p-6 mb-6">
        @if (session()->has('success'))
            <div class="text-green-600 mb-4 p-3 bg-green-50 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Site Name') }}</label>
            <div class="relative">
                <input type="text" wire:model.defer="site_name"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="{{ __('Enter Site Name') }}" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-4">
            {{-- Logo --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="mb-3 flex items-center justify-between space-x-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Logo') }}</label>
                    @if ($new_logo)
                        <img src="{{ $new_logo->temporaryUrl() }}" class="h-10 w-10 rounded-md shadow" />
                    @elseif ($site_logo)
                        <div class="relative">
                            <img src="{{ asset($site_logo) }}" class="h-10 w-10 rounded-md shadow mx-2" />
                            <button wire:click="removeLogo" type="button"
                                class="absolute top-0 left-0 bg-red-600 text-white rounded-full p-1 text-xs hover:bg-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="flex items-center justify-center w-full">
                    <label for="new_logo"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">{{ __("Click to upload") }}</span> {{ __('or drag and drop') }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="new_logo" type="file" wire:model="new_logo" class="hidden" />
                    </label>
                </div>
            </div>

            {{-- Favicon --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="mb-3 flex items-center justify-between space-x-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Favicon') }}</label>

                    @if ($new_favicon)
                        <img src="{{ $new_favicon->temporaryUrl() }}" class="h-10 w-10 rounded-md shadow" />
                    @elseif ($favicon)
                        <div class="relative">
                            <img src="{{ asset($favicon) }}" class="h-10 w-10 rounded-md shadow mx-2" />
                            <button wire:click="removeFavicon" type="button"
                                class="absolute top-0 left-0 bg-red-600 text-white rounded-full p-1 text-xs hover:bg-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-center w-full">
                    <label for="new_favicon"
                        class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">{{ __("Click to upload") }}</span> {{ __('or drag and drop') }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                ICO, PNG, JPG (MAX. 256x256px)
                            </p>
                        </div>
                        <input id="new_favicon" type="file" wire:model="new_favicon" class="hidden" />
                    </label>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Primary Color') }}</label>
                <input type="color" id="primary_color" wire:model.defer="primary_color"
                    class="w-full h-10 rounded-full cursor-pointer transition duration-200" />
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Secondary Color') }}</label>
                <input type="color" id="secondary_color" wire:model.defer="secondary_color"
                    class="w-full h-10 rounded-full cursor-pointer transition duration-200" />
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Accent Color') }}</label>
                <input type="color" id="accent_color" wire:model.defer="accent_color"
                    class="w-full h-10 rounded-full cursor-pointer transition duration-200" />
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Background Color') }}</label>
                <input type="color" id="background_color" wire:model.defer="background_color"
                    class="w-full h-10 rounded-full cursor-pointer transition duration-200" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 p-1">
            {{-- Box 1: primary + secondary --}}
            <div id="box-primary-secondary"
                class="rounded-lg border border-gray-200 p-6 cursor-pointer text-white font-semibold text-center transition-all hover:shadow-lg"
                style="background-image: linear-gradient(to right, {{ $primary_color }}, {{ $secondary_color }});">
                {{ __('Primary Color') }} + {{ __('Secondary Color') }}
            </div>

            {{-- Box 2: accent + background --}}
            <div id="box-accent-background"
                class="rounded-lg border border-gray-200 p-6 cursor-pointer text-white font-semibold text-center transition-all hover:shadow-lg"
                style="background-image: linear-gradient(to right, {{ $accent_color }}, {{ $background_color }});">
                {{ __('Accent Color') }} + {{ __('Background Color') }}
            </div>
        </div>

        <div class="flex space-x-4 mt-4">
            <button wire:click="save"
                class="bg-blue-600 shadow-soft-xl hover:bg-blue-700 text-white px-4 py-2 rounded-md btn-bg mx-2">
                {{ __('Save Settings') }}
            </button>
            <button wire:click="$set('confirmingReset', true)" type="button"
                class="bg-red-600 shadow-soft-xl hover:bg-red-700 text-white px-4 py-2 rounded-md">
                {{ __('Reset Settings') }}
            </button>
        </div>
    </div>

    {{-- confirming Reset Modal --}}
    @if ($confirmingReset)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full space-y-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ __('Confirm reset settings') }}
                </h2>
                <p class="text-gray-600 text-sm">
                    {{ __('Are you sure you want to revert the default settings? This will delete the existing logo and favicon.') }}
                </p>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('confirmingReset', false)" type="button"
                        class="px-4 py-2 rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 mx-2">
                        {{ __('Cancel') }}
                    </button>

                    <button wire:click="resetToDefaults" wire:loading.attr="disabled"
                        class="px-4 py-2 rounded-md text-white bg-red-600 hover:bg-red-700">
                        {{ __('Yes, reset settings') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const primary = document.getElementById('primary_color');
                const secondary = document.getElementById('secondary_color');
                const accent = document.getElementById('accent_color');
                const background = document.getElementById('background_color');

                const boxPrimary = document.getElementById('box-primary-secondary');
                const boxAccent = document.getElementById('box-accent-background');

                function updateGradients() {
                    boxPrimary.style.backgroundImage =
                        `linear-gradient(to right, ${primary.value}, ${secondary.value})`;
                    boxAccent.style.backgroundImage = `linear-gradient(to right, ${accent.value}, ${background.value})`;
                }

                [primary, secondary, accent, background].forEach(input => {
                    input.addEventListener('input', updateGradients);
                });

                // Initial call
                updateGradients();
            });
        </script>
    @endpush
</div>
