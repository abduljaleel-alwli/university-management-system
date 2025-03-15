@php
    $isSuperAdmin = auth()->user()->hasRole('super-admin');
@endphp

<div class="p-6 rounded-lg" id="postGraduationForm">
    <div class="bg-white shadow-soft-xl rounded-2xl p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('Post Graduation Management') }}</h2>

        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <div class="space-y-4">
            <!-- موعد المناقشة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Discussion Date') }}</label>
                <input type="date" wire:model.defer="discussion_date"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    @if ($isSuperAdmin) disabled @endif>
            </div>

            <!-- قرار اللجنة -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Committee Decision') }}</label>
                <input type="text" wire:model.defer="committee_decision"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    @if ($isSuperAdmin) disabled @endif>
            </div>
        </div>


        <!-- الخيارات -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
            <label class="flex items-center space-x-2">
                @if ($clearance)
                    <input type="checkbox" wire:model.defer="clearance"
                        class="rounded border-gray-300 focus:ring-blue-500" checked
                        @if ($isSuperAdmin) disabled @endif>
                @else
                    <input type="checkbox" wire:model.defer="clearance"
                        class="rounded border-gray-300 focus:ring-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                @endif
                <span class="text-gray-700"> {{ __('Clearance') }}</span>
            </label>
            <label class="flex items-center space-x-2">
                @if ($sent_to_college)
                    <input type="checkbox" wire:model.defer="sent_to_college"
                        class="rounded border-gray-300 focus:ring-blue-500" checked
                        @if ($isSuperAdmin) disabled @endif>
                @else
                    <input type="checkbox" wire:model.defer="sent_to_college"
                        class="rounded border-gray-300 focus:ring-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                @endif
                <span class="text-gray-700"> {{ __('Sent to College Board') }}</span>
            </label>
            <label class="flex items-center space-x-2">
                @if ($sent_to_ministry)
                    <input type="checkbox" wire:model.defer="sent_to_ministry"
                        class="rounded border-gray-300 focus:ring-blue-500" checked
                        @if ($isSuperAdmin) disabled @endif>
                @else
                    <input type="checkbox" wire:model.defer="sent_to_ministry"
                        class="rounded border-gray-300 focus:ring-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                @endif
                <span class="text-gray-700"> {{ __('Sent to Ministry') }}</span>
            </label>
            <label class="flex items-center space-x-2">
                @if ($archived)
                    <input type="checkbox" wire:model.defer="archived"
                        class="rounded border-gray-300 focus:ring-blue-500" checked
                        @if ($isSuperAdmin) disabled @endif>
                @else
                    <input type="checkbox" wire:model.defer="archived"
                        class="rounded border-gray-300 focus:ring-blue-500"
                        @if ($isSuperAdmin) disabled @endif>
                @endif
                <span class="text-gray-700"> {{ __('Archived') }}</span>
            </label>
        </div>

        <!-- حالة الطالب -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700">{{ __('Student Status') }}</label>
            <select wire:model.defer="post_graduation_status"
                class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                @if ($isSuperAdmin) disabled @endif>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        @role('admin')
            <div id="saveButton" class="mt-6 text-center hidden">
                <button wire:click="save"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out shadow-md hover:shadow-lg">
                    {{ __('Save Changes') }}
                </button>
            </div>
        @endrole
    </div>

    <!-- بيانات الطالب -->
    <div class="bg-white shadow-soft-xl rounded-xl p-6 mt-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">{{ __('Student Details') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $fields = [
                    'first_name_ar' => __('First Name (Arabic)'),
                    'first_name_en' => __('First Name (English)'),
                    'father_name_ar' => __('Father Name (Arabic)'),
                    'father_name_en' => __('Father Name (English)'),
                    'grandfather_name_ar' => __('Grandfather Name (Arabic)'),
                    'grandfather_name_en' => __('Grandfather Name (English)'),
                    'last_name_ar' => __('Last Name (Arabic)'),
                    'last_name_en' => __('Last Name (English)'),
                    'email' => __('Email'),
                    'phone_number' => __('Phone Number'),
                ];
            @endphp

            @foreach ($fields as $key => $label)
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                    <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                        <p class="text-gray-900">{{ $student->$key }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @role('admin')
            <a href="{{ route('admin.students.show', ['student' => $student->id]) }}"
                class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                {{ __('View') }}
            </a>
        @elseif('super-admin')
            <a href="{{ route('super-admin.students.show', ['student' => $student->id]) }}"
                class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                {{ __('View') }}
            </a>
        @endrole
    </div>
</div>

@role('admin')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.getElementById("postGraduationForm");
            let saveButton = document.getElementById("saveButton");

            // مراقبة التغييرات داخل الفورم
            form.addEventListener("input", function() {
                saveButton.classList.remove("hidden"); // إظهار الزر عند حدوث تغيير
            });

            saveButton.addEventListener("click", function() {
                setTimeout(() => {
                    saveButton.classList.add("hidden"); // إخفاء الزر بعد الحفظ
                }, 1000);
            });
        });
    </script>
@endrole
