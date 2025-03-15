<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- زر العودة إلى القائمة -->
                    <div class="mb-6">
                        <a href="{{ route('super-admin.students.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <!-- بطاقة عرض تفاصيل الطالب -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- الاسم (عربي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('First Name (Arabic)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->first_name_ar }}</p>
                                </div>
                            </div>

                            <!-- الاسم (إنجليزي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('First Name (English)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->first_name_en }}</p>
                                </div>
                            </div>

                            <!-- اسم الأب (عربي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Father Name (Arabic)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->father_name_ar }}</p>
                                </div>
                            </div>

                            <!-- اسم الأب (إنجليزي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Father Name (English)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->father_name_en }}</p>
                                </div>
                            </div>

                            <!-- اسم الجد (عربي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Grandfather Name (Arabic)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->grandfather_name_ar }}</p>
                                </div>
                            </div>

                            <!-- اسم الجد (إنجليزي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Grandfather Name (English)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->grandfather_name_en }}</p>
                                </div>
                            </div>

                            <!-- اللقب (عربي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Last Name (Arabic)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->last_name_ar }}</p>
                                </div>
                            </div>

                            <!-- اللقب (إنجليزي) -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Last Name (English)') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->last_name_en }}</p>
                                </div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->email }}</p>
                                </div>
                            </div>

                            <!-- رقم الهاتف -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Phone Number') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->phone_number }}</p>
                                </div>
                            </div>

                            <!-- نوع الدراسة -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Study Type') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">
                                        {{ $student->study_type == 'msc' ? __('Master') : __('PhD') }}
                                    </p>
                                </div>
                            </div>

                            <!-- تاريخ المباشرة -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Start Date') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->start_date }}</p>
                                </div>
                            </div>

                            <!-- تاريخ انتهاء الدراسة -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Study End Date') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->study_end_date }}</p>
                                </div>
                            </div>

                            <!-- قناة القبول -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Admission Channel') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">
                                        {{ $student->admission_channel == 'private' ? __('Private') : __('Public') }}
                                    </p>
                                </div>
                            </div>

                            <!-- المرحلة الدراسية -->
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Academic Stage') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">
                                        {{ $student->academic_stage == 'preparatory' ? __('Preparatory Year') : __('Research Year') }}
                                    </p>
                                </div>
                            </div>

                            <!-- الحالة -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">
                                        @if ($student->status == 'active')
                                            <span
                                                class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ __('Active') }}</span>
                                        @elseif ($student->status == 'suspended')
                                            <span
                                                class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ __('Suspended') }}</span>
                                        @else
                                            <span
                                                class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ __('Pending Review') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-medium text-gray-700">{{ __('Specialization Type') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">
                                        {{ $student->specialization_type_translated }}
                                    </p>
                                </div>
                            </div>

                            <!-- الملاحظات -->
                            <div class="col-span-1 md:col-span-2 space-y-2">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Notes') }}</label>
                                <div class="mt-1 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $student->notes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
