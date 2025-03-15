<select id="{{ $id }}" name="{{ $name }}" class="mt-1 block w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 {{ $class }}"
    @if (isset($wireModel)) wire:model="{{ $wireModel }}" @endif
    @isset($onchange) onchange="{{ $onchange }}" @endisset
    @isset($required) required @endisset>
    {{ $slot }}
</select>
