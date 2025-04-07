<div class="bg-white p-6 rounded-lg shadow-soft-xl mt-6 space-y-4">

    <!-- قسم البحث والإضافة -->
    <div class="flex mb-4 gap-2">
        <div class="flex items-center gap-2 w-full md:w-auto">
            <livewire:department-form />

            <button wire:click="searchDepartments" wire:loading.attr="disabled"
                class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl shadow-md font-semibold
                                hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                                whitespace-nowrap btn-bg">
                <span>{{ __('Search') }}</span>
                <span wire:loading wire:target="searchDepartments">
                    <svg class="animate-spin h-5 w-5 text-white transition-transform duration-500"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>

            <input type="text" wire:model="search" placeholder="{{ __('Search a Department') }}..."
                class="flex-grow px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <!-- الجدول -->
    <div class="overflow-x-auto border-gray-200 rounded-lg shadow-sm">
        <table class="w-full">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-center">#</th>
                    <th class="px-6 py-3 text-center">{{ __('Name (Arabic)') }}</th>
                    <th class="px-6 py-3 text-center">{{ __('Name (English)') }}</th>
                    <th class="px-6 py-3 text-center">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($departments as $index => $department)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 text-sm text-center font-medium text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $department->name_ar }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $department->name_en }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2" style="justify-content: center">
                                <a href="{{ route('super-admin.departments.show', parameters: $department->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm transition duration-200 mx-2">
                                    {{ __('Show') }}
                                </a>
                                <button wire:click="$dispatch('openModal', { departmentId: {{ $department->id }} })"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition duration-200">
                                    {{ __('Edit') }}
                                </button>
                                <button
                                    wire:click="$dispatch('confirmDelete', { departmentId: {{ $department->id }} })"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition duration-200">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
