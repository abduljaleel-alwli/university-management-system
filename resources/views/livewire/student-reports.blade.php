<div class="container mx-auto p-6">

    {{-- نموذج البحث --}}
    <div class="bg-white shadow-soft-xl rounded-xl p-6 mb-6 mt-1">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold mb-4">{{ __('Create report') }}</h2>
            <div>
                <button wire:click="searchStudents"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out btn-bg">
                    {{ __('Search') }}
                </button>
                <button wire:click="export"
                    class="bg-green-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-600 transition duration-200 ease-in-out">
                    {{ __('Export to Excel') }}
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach (['first_name' => __('First Name'), 'father_name' => __('Father Name'), 'grandfather_name' => __('Grandfather Name'), 'last_name' => __('Last Name'), 'email' => __('Email'), 'phone_number' => __('Phone Number')] as $field => $placeholder)
                <input type="text" wire:model="search.{{ $field }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="{{ $placeholder }}">
            @endforeach

            @foreach ([
        'study_type' => ['' => __('Study Type'), 'msc' => __('Master'), 'phd' => __('PhD')],
        'admission_channel' => ['' => __('Admission Channel'), 'private' => __('Private'), 'public' => __('Public')],
        'academic_stage' => ['' => __('Academic Stage'), 'preparatory' => __('Preparatory'), 'research' => __('Research')],
    ] as $field => $options)
                <select wire:model="search.{{ $field }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    @foreach ($options as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3">

            <div>
                @foreach ([
        'status' => ['' => __('Status'), 'active' => __('Active'), 'suspended' => __('Suspended'), 'pending_review' => __('Pending Review')],
    ] as $field => $options)
                    <label for="status">{{ __('Status') }}</label>
                    <select wire:model="search.{{ $field }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>

            <div>
                <label for="start_date">{{ __('Start Date') }}</label>
                <input type="date" wire:model="search.start_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>

            <div>
                <label for="study_end_date">{{ __('Study End Date') }}</label>
                <input type="date" wire:model="search.study_end_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>

            <div>
                <label for="department_id">{{ __('Department') }}</label>
                <select wire:model="search.department_id"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- عرض النتائج --}}
    <div class="py-6">
        <div class="bg-white shadow-soft-xl rounded-xl p-6 mb-6">
            <div>
                <!-- جدول عرض الطلاب -->
                <div class="overflow-x-auto shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Email') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Phone Number') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Start Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Study End Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Department') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Study Type') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Admission Channel') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Academic Stage') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Specialization Type') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Notes') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($students as $index => $student)
                                @php
                                    // التحقق مما إذا كان لدى الطالب تاريخ انتهاء دراسة
                                    $studyEndDate = $student->study_end_date
                                        ? \Carbon\Carbon::parse($student->study_end_date)
                                        : null;
                                    $remainingMonths = $studyEndDate
                                        ? \Carbon\Carbon::now()->diffInMonths($studyEndDate, false)
                                        : null;
                                    $isCloseToEnd =
                                        $remainingMonths !== null && $remainingMonths <= 3 && $remainingMonths >= 0;

                                    $isSuspended = $student->status == 'suspended';
                                    $isPendingReview = $student->status == 'pending_review';

                                    $rowClass = '';
                                    if ($isCloseToEnd) {
                                        $rowClass = 'bg-red-50';
                                    } elseif ($isSuspended) {
                                        $rowClass = 'bg-yellow-50';
                                    } elseif ($isPendingReview) {
                                        $rowClass = 'bg-gradient-pending from-gray-100 to-gray-200';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ e($student->first_name) }} {{ e($student->father_name) }}
                                        {{ e($student->last_name) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ e($student->email) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->phone_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->study_end_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->department->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->study_type == 'msc' ? __('Master') : __('PhD') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->admission_channel == 'public' ? __('Public') : __('Private') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->academic_stage == 'research' ? __('Research Year') : __('Preparatory Year') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm status">
                                        @if ($student->status == 'active')
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ __('Active') }}
                                            </span>
                                        @elseif ($student->status == 'suspended')
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ __('Suspended') }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ __('Pending Review') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->specialization_type_translated }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->notes }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('super-admin.students.show', $student->id) }}"
                                                class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg">{{ __('View') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $students->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
