<div class="min-h-screen flex flex-col sm:justify-center items-center sm:justify-flex-start">
    <div class="py-4">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-soft-xl rounded-2xl overflow-hidden" @isset($style) style="{{ $style }}" @endisset>
        {{ $slot }}
    </div>
</div>
