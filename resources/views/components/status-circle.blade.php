<div class="relative" x-data="{ tooltip: false }">
    <div @mouseover="tooltip = true" @mouseleave="tooltip = false"
         class="w-10 h-10 rounded-full shadow-md cursor-pointer {{ __($color) }}">
    </div>
    <div x-show="tooltip"
         class="absolute top-full mt-2 left-1/2 transform -translate-x-1/2 whitespace-nowrap bg-gray-800 text-white text-xs rounded px-3 py-1 shadow-lg z-10"
         x-cloak>
        {{ __($label) }}
    </div>
</div>
