<div class="bg-white p-6 rounded-lg shadow-soft-xl mt-6 space-y-4">

    <!-- قسم البحث والإضافة -->
    <div class="flex mb-4 gap-2">
        <livewire:department-form />

        <button wire:click="searchDepartments" class="px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded-lg shadow-md btn-bg">
            {{ __('Search') }}
        </button>

        <input type="text" wire:model="search" placeholder="{{ __('Search a Department') }}..."
            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- الجدول -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg shadow-sm">
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
                                    class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm transition duration-200">
                                    {{ __('Show') }}
                                </a>
                                <button wire:click="$dispatch('openModal', { departmentId: {{ $department->id }} })"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition duration-200">
                                    {{ __('Edit') }}
                                </button>
                                <button wire:click="$dispatch('confirmDelete', { departmentId: {{ $department->id }} })"
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
