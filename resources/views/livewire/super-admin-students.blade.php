<div class="container mx-auto p-4">

    <!-- نموذج البحث -->
    <div class="bg-white shadow-soft-xl rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <!-- زر البحث مع لودينق -->
            <button wire:click="searchStudents" wire:loading.attr="disabled"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out flex items-center gap-2 btn-bg">
                <span>{{ __('Search') }}</span>
                <span wire:loading wire:target="searchStudents">
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
            <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg shadow-sm text-sm font-semibold">
                {{ __('Total Results') }}: <span class="text-blue-600">{{ $students->total() }}</span>
            </div>
            <!-- حقل القسم -->
            <div>
                <label for="department_id" class="p-3">{{ __('Department') }}</label>
                <select wire:model="search.department_id"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    <option value="">{{ __('Select Department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- حقول النص -->
            @foreach (['first_name' => __('First Name'), 'father_name' => __('Father Name'), 'grandfather_name' => __('Grandfather Name'), 'last_name' => __('Last Name'), 'email' => __('Email'), 'phone_number' => __('Phone Number')] as $field => $placeholder)
                <input type="text" wire:model="search.{{ $field }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="{{ $placeholder }}">
            @endforeach

            <!-- حقول التحديد (Select) -->
            @foreach ([
        'study_type' => ['' => __('Study Type'), 'msc' => __('Master'), 'phd' => __('PhD')],
        'admission_channel' => ['' => __('Admission Channel'), 'private' => __('Private'), 'public' => __('Public')],
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
            <!-- حقل المرحلة الاكاديمية -->
            <div>
                @foreach ([
        'academic_stage' => ['' => __('Academic Stage'), 'preparatory' => __('Preparatory'), 'research' => __('Research')],
    ] as $field => $options)
                    <label for="status" class="p-3">{{ __('Academic Stage') }}</label>
                    <select wire:model="search.{{ $field }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>

            <!-- حقل حالة الطالب -->
            <div>
                @foreach ([
        'status' => [
            '' => __('Status'),
            'active' => __('Active'),
            'suspended' => __('Suspended'),
            'pending_review' => __('Pending Review'),
            'graduate' => __('Graduate'),
            'fail' => __('Fail'),
        ],
    ] as $field => $options)
                    <label for="status" class="p-3">{{ __('Status') }}</label>
                    <select wire:model="search.{{ $field }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>

            <!-- حقل تاريخ البدء -->
            <div>
                <label for="start_date" class="p-3">{{ __('Start Date') }}</label>
                <input type="date" wire:model="search.start_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>

            <!-- حقل تاريخ انتهاء الدراسة -->
            <div>
                <label for="study_end_date" class="p-3">{{ __('Study End Date') }}</label>
                <input type="date" wire:model="search.study_end_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
        </div>
    </div>

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
                                    {{ __('Start Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Study End Date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Specialization') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Admission Channel') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
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
                                    $isPendingReview =
                                        $student->status == 'pending_review' &&
                                        !isset($student->postGraduationStep->id);

                                    $isPendingReviewAndisPostGraduation =
                                        $student->status == 'pending_review' && isset($student->postGraduationStep->id);

                                    $hasPostGraduationAndNotPendingReview =
                                        $isPendingReviewAndisPostGraduation &&
                                        $student->postGraduationStep->post_graduation_status == 'pending_review';

                                    $status = null;
                                    if ($student->postGraduationStep) {
                                        $status = $student->postGraduationStep->post_graduation_status;
                                    }

                                    $rowClass = '';
                                    if ($status == 'graduate') {
                                        $rowClass = 'bg-green-100';
                                    } elseif ($status == 'fail') {
                                        $rowClass = 'bg-red-100';
                                    } elseif ($isCloseToEnd) {
                                        $rowClass = 'bg-orange-500 is-close-to-end';
                                    } elseif ($isSuspended) {
                                        $rowClass = 'bg-yellow-100';
                                    } elseif ($isPendingReview) {
                                        $rowClass = 'bg-gradient-pending from-gray-100 to-gray-100';
                                    } elseif ($isPendingReviewAndisPostGraduation) {
                                        $rowClass = 'bg-gradient-pending-2 from-gray-100 to-gray-100';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ e($student->first_name) }} {{ e($student->father_name) }}
                                        {{ e($student->last_name) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->study_end_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->specializationType->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->admission_channel_translated }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm status">
                                        @if ($status == 'graduate')
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                                {{ __('Graduate') }}
                                            </span>
                                        @elseif($status == 'fail')
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                {{ __('Fail') }}
                                            </span>
                                        @elseif ($student->status == 'active')
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('super-admin.students.show', $student->id) }}"
                                                class="bg-blue-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg"
                                                title="{{ __('View student details') }}">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path opacity="0.5"
                                                            d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                            stroke="#ffffff" stroke-width="1.5"></path>
                                                        <path
                                                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                            stroke="#ffffff" stroke-width="1.5"></path>
                                                    </g>
                                                </svg>
                                            </a>
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
