<div>
    <!-- زر إضافة قسم جديد -->
    <button wire:click="openModal" style="width: 160px" class="bg-blue-500 text-white px-4 py-2 rounded-md btn-bg">{{ __('New Department') }}</button>

    <!-- المودال -->
    @if ($modalOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-modal bg-opacity-50 absolute inset-0" wire:click="$set('modalOpen', false)"></div>
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 z-10">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $department_id ? __('Edit Department') : __('Add a new Department') }}
                </h2>

                <div class="mb-4">
                    <label class="block text-gray-700">{{ __('Name (Arabic)') }}</label>
                    <input type="text" wire:model="name_ar" class="w-full border rounded p-2">
                    @error('name_ar')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">{{ __('Name (English)') }}</label>
                    <input type="text" wire:model="name_en" class="w-full border rounded p-2">
                    @error('name_en')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('modalOpen', false)"
                        class="px-4 py-2 bg-gray-300 rounded-md">{{ __('Cancel') }}</button>
                    <button wire:click="save" class="px-4 py-2 bg-blue-500 text-white rounded-md btn-bg">
                        {{ $department_id ? __('Update') : __('Save') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- المودال الخاص بحذف القسم -->
    @if ($confirmDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-modal bg-opacity-50 absolute inset-0" wire:click="$set('confirmDeleteModal', false)">
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 z-10">
                <h2 class="text-xl font-semibold mb-4 text-red-600">{{ __('Warning') }}</h2>
                <p class="mb-4">{{ __('Are you sure you want to delete this department? This process cannot be undone.') }}</p>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('confirmDeleteModal', false)"
                        class="px-4 py-2 bg-gray-300 rounded-md">{{ __('Cancel') }}</button>
                    <button wire:click="deleteDepartment"
                        class="px-4 py-2 bg-red-500 text-white rounded-md">{{ __('Delete') }}</button>
                </div>
            </div>
        </div>
    @endif

</div>
