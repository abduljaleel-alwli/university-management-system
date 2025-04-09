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

            <!-- عدد النتائج -->
            <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg shadow-sm text-sm font-semibold">
                {{ __('Total Results') }}: <span class="text-blue-600">{{ $students->total() }}</span>
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
        'academic_stage' => ['' => __('Academic Stage'), 'preparatory' => __('Preparatory'), 'research' => __('Research')],
        'status' => [
            '' => __('Status'),
            'active' => __('Active'),
            'suspended' => __('Suspended'),
            'pending_review' => __('Pending Review'),
            'graduate' => __('Graduate'),
            'fail' => __('Fail'),
        ],
    ] as $field => $options)
                @if ($field == 'status')
                    <div>
                        <label for="status" class="pb-2">{{ __('Status') }}</label>
                        <select wire:model="search.{{ $field }}"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            @foreach ($options as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <select wire:model="search.{{ $field }}"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @endif
            @endforeach

            <!-- حقول التاريخ -->
            <div>
                <label for="start_date" class="pb-2">{{ __('Start Date') }}</label>
                <input type="date" wire:model="search.start_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
            <div>
                <label for="study_end_date" class="pb-2">{{ __('Study End Date') }}</label>
                <input type="date" wire:model="search.study_end_date"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="tooltips static-tooltips">
            <div class="tips-box bg-white shadow-soft-xl rounded-xl p-6 mb-6">
                <x-status-circle color="bg-white tip-circle" label="Active" />
                <x-status-circle color="bg-green-100 tip-circle" label="Graduate" />
                <x-status-circle color="bg-red-100 tip-circle" label="Fail" />
                <x-status-circle color="bg-yellow-100 tip-circle" label="Suspended" />
                <x-status-circle color="bg-orange-500 is-close-to-end tip-circle" label="The student study period ends after 3 months." />
                <x-status-circle color="bg-gradient-pending from-gray-100 to-gray-100 tip-circle" label="Pending Review" />
                <x-status-circle color="bg-gradient-pending-2 from-gray-100 to-gray-100 tip-circle"
                    label="Post-Graduation discussion Pending Review" />
            </div>
        </div>
        <div class="bg-white shadow-soft-xl rounded-xl p-6 mb-6">
            <div>
                <!-- زر إضافة طالب جديد -->
                <div class="mb-6">
                    <a href="{{ route('admin.students.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition btn-bg">
                        {{ __('Add New Student') }}
                    </a>
                </div>

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
                                            <a href="{{ route('admin.students.show', $student->id) }}"
                                                class="bg-blue-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg mx-2"
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
                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                                class="bg-yellow-500 text-white px-2 py-2 rounded-lg text-sm hover:bg-yellow-600 transition"
                                                alt="{{ __('Edit') }}" title="{{ __('Edit Student Details') }}">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M18.9445 9.1875L14.9445 5.1875M18.9445 9.1875L13.946 14.1859C13.2873 14.8446 12.4878 15.3646 11.5699 15.5229C10.6431 15.6828 9.49294 15.736 8.94444 15.1875C8.39595 14.639 8.44915 13.4888 8.609 12.562C8.76731 11.6441 9.28735 10.8446 9.946 10.1859L14.9445 5.1875M18.9445 9.1875C18.9445 9.1875 21.9444 6.1875 19.9444 4.1875C17.9444 2.1875 14.9445 5.1875 14.9445 5.1875M20.5 12C20.5 18.5 18.5 20.5 12 20.5C5.5 20.5 3.5 18.5 3.5 12C3.5 5.5 5.5 3.5 12 3.5"
                                                            stroke="#ffffff" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                            <button onclick="openDeleteModal({{ $student->id }})"
                                                class="bg-red-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-red-700 transition "
                                                title="{{ __('Delete this student') }}">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6.98996C8.81444 4.87965 15.1856 4.87965 21 6.98996"
                                                            stroke="#ffffff" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path
                                                            d="M8.00977 5.71997C8.00977 4.6591 8.43119 3.64175 9.18134 2.8916C9.93148 2.14146 10.9489 1.71997 12.0098 1.71997C13.0706 1.71997 14.0881 2.14146 14.8382 2.8916C15.5883 3.64175 16.0098 4.6591 16.0098 5.71997"
                                                            stroke="#ffffff" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M12 13V18" stroke="#ffffff" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path
                                                            d="M19 9.98999L18.33 17.99C18.2225 19.071 17.7225 20.0751 16.9246 20.8123C16.1266 21.5494 15.0861 21.9684 14 21.99H10C8.91389 21.9684 7.87336 21.5494 7.07541 20.8123C6.27745 20.0751 5.77745 19.071 5.67001 17.99L5 9.98999"
                                                            stroke="#ffffff" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button onclick="openPaymentModal({{ $student->id }})"
                                                class="bg-green-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-green-700 transition
                                                {{ $student->admission_channel !== 'private' ? 'disabled' : '' }}"
                                                title="{{ __('Click to add a payment for this student') }}">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M12 17V17.5V18" stroke="#fff" stroke-width="1.5"
                                                            stroke-linecap="round"></path>
                                                        <path d="M12 6V6.5V7" stroke="#fff" stroke-width="1.5"
                                                            stroke-linecap="round"></path>
                                                        <path
                                                            d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                                            stroke="#fff" stroke-width="1.5"
                                                            stroke-linecap="round"></path>
                                                        <path
                                                            d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                                            stroke="#fff" stroke-width="1.5"
                                                            stroke-linecap="round"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                            @if ($hasPostGraduationAndNotPendingReview)
                                                <a href="{{ route('admin.post-graduation.show', $student->postGraduationStep->id) }}"
                                                    class="bg-gray-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-gray-700 transition btn-bg-2"
                                                    title="{{ __('Click to complete post-graduation process') }}">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="#ebebeb"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                                                stroke="#ebebeb" stroke-width="1.5"
                                                                stroke-linecap="round"></path>
                                                        </g>
                                                    </svg>
                                                </a>
                                            @else
                                                <button onclick="openPostGraduationModal({{ $student->id }})"
                                                    class="bg-green-600 text-white px-2 py-2 rounded-lg text-sm hover:bg-green-700 transition btn-bg
                                                    {{ $student->status == 'suspended' ? 'disabled' : '' }}"
                                                    title="{{ __('Click to add post-graduation details for this student') }}">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M3.09155 6.63659L9.78267 3.49965C11.2037 2.83345 12.7961 2.83345 14.2171 3.49965L20.9083 6.63664C22.3638 7.31899 22.3638 9.68105 20.9083 10.3634L14.2172 13.5003C12.7962 14.1665 11.2038 14.1665 9.78275 13.5003L4.99995 11.2581"
                                                                stroke="#f0f0f0" stroke-width="1.5"
                                                                stroke-linecap="round"></path>
                                                            <path opacity="0.5"
                                                                d="M2.5 15V12.1376C2.5 10.8584 2.5 10.2188 2.83032 9.71781C3.16064 9.21687 3.74853 8.96492 4.92432 8.461L6 8"
                                                                stroke="#f0f0f0" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path opacity="0.5"
                                                                d="M19 11.5V16.6254C19 17.6334 18.4965 18.5772 17.6147 19.0656C16.1463 19.8787 13.796 21 12 21C10.204 21 7.8537 19.8787 6.38533 19.0656C5.5035 18.5772 5 17.6334 5 16.6254V11.5"
                                                                stroke="#f0f0f0" stroke-width="1.5"
                                                                stroke-linecap="round"></path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $students->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal for Create Payment -->
    <div id="paymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden"
        style="background: #24262b26">
        <div class="modal-box bg-white p-6 rounded-lg shadow-lg w-1/3 mt-6">
            <h2 class="text-xl font-semibold mb-4">{{ __('Add New Payment') }}</h2>

            <form id="paymentForm">
                @csrf
                <input type="hidden" id="student_id" name="student_id">

                <div class="mb-4">
                    <label for="amount"
                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('Amount') }}</label>
                    <div class="relative">
                        <input type="number" id="amount" name="amount"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="{{ __('Enter amount') }}" required>
                    </div>
                </div>

                <div class="mb-4 flex gap-4 items-center">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Currency') }}</label>
                        <select id="currency" name="currency"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="IQD">{{ __('Iraqi Dinar') }}</option>
                            <option value="USD">{{ __('US Dollar') }}</option>
                        </select>
                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Payment Date') }}</label>
                        <input type="date" id="payment_date" name="payment_date"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('Notes') }}</label>
                    <textarea id="notes" name="notes" rows="2"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        placeholder="{{ __('Enter your notes here') }}..."></textarea>
                </div>

                <div id="responseMessage" class="mb-4 text-center"></div>

                <div class="flex justify-end">
                    <div class="bg-gray-400 px-4 py-2 rounded-md text-white mr-2">
                        <button type="button" class="w-full" onclick="closePaymentModal()">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="bg-blue-600 px-4 py-2 rounded-md text-white mx-2">
                        <button type="submit" class="w-full">
                            {{ __('Save Payment') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Post Graduation Step -->
    <div id="postGraduationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden"
        style="background: #24262b26">
        <div class="modal-box bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">{{ __('Add Post Graduation Step') }}</h2>

            <form id="postGraduationForm">
                @csrf
                <input type="hidden" id="post_graduation_student_id" name="student_id" required>

                <div id="responsePostGraduationMessage" class="mb-4 text-center"></div>

                <div class="mb-4">
                    <label for="discussion_date" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Discussion Date') }}
                    </label>
                    <input type="date" id="discussion_date" name="discussion_date"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        required>
                </div>

                <div style="display: none">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Committee Decision') }}</label>
                        <input type="text" id="committee_decision" name="committee_decision"
                            class="w-full mt-1 p-2 border rounded-md">
                    </div>

                    <div class="mb-4 flex gap-4">
                        <label class="flex items-center">
                            <input type="hidden" name="clearance" value="0">
                            <input type="checkbox" id="clearance" name="clearance" class="mr-2">
                            {{ __('Clearance') }}
                        </label>
                        <label class="flex items-center">
                            <input type="hidden" name="sent_to_college" value="0">
                            <input type="checkbox" id="sent_to_college" name="sent_to_college" class="mr-2">
                            {{ __('Sent to College') }}
                        </label>
                        <label class="flex items-center">
                            <input type="hidden" name="sent_to_ministry" value="0">
                            <input type="checkbox" id="sent_to_ministry" name="sent_to_ministry" class="mr-2">
                            {{ __('Sent to Ministry') }}
                        </label>
                        <label class="flex items-center">
                            <input type="hidden" name="archived" value="0">
                            <input type="checkbox" id="archived" name="archived" class="mr-2">
                            {{ __('Archived') }}
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Student Status') }}</label>
                        <select id="post_graduation_status" name="post_graduation_status"
                            class="w-full mt-1 p-2 border rounded-md">
                            <option value="pending_review">{{ __('Pending Review') }}</option>
                            <option value="graduate">{{ __('Graduate') }}</option>
                            <option value="fail">{{ __('Fail') }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="bg-gray-400 px-4 py-2 rounded-md text-white mx-2">
                        <button type="button" class="w-full" onclick="closePostGraduationModal()">
                            {{ __('Cancel') }}
                        </button>
                    </div>

                    <div id="saveButtonWrapper" class="bg-blue-600 px-4 py-2 rounded-md text-white">
                        <button type="submit" class="w-full">
                            {{ __('Save') }}
                        </button>
                    </div>

                    <div id="loadingButtonWrapper" class="bg-blue-600 px-4 py-2 rounded-md text-white">
                        <button class="w-full">
                            <span>
                                <svg class="animate-spin h-5 w-5 text-white transition-transform duration-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Confirming Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
        style="background: #24262b26">
        <div class="modal-box bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                {{ __('Are you sure you want to delete this student?') }}
            </h3>
            <form id="deleteForm" action="#" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-between">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded bg-gray-300">{{ __('Cancel') }}</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-300 mx-2">{{ __('Confirm') }}
                        {{ __('Delete') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tailwind Modal JavaScript -->
    <script>
        function openDeleteModal(student_id) {
            // Set the form action to delete the user
            const form = document.getElementById('deleteForm');
            form.action = '/panel/students/' + student_id;

            // Show the modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            // Hide the modal
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

    <!-- Payment Modal -->
    <script>
        function openPaymentModal(studentId) {
            document.getElementById('student_id').value = studentId;
            document.getElementById('paymentModal').classList.remove('hidden');
            document.getElementById('responseMessage').innerHTML = ''; // مسح الرسالة السابقة
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('admin.payments.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    let messageBox = document.getElementById('responseMessage');

                    if (data.error) {
                        messageBox.innerHTML = `<p class="text-red-600">${data.error}</p>`;
                    } else {
                        messageBox.innerHTML = `<p class="text-green-600">${data.success}</p>`;
                        setTimeout(() => {
                            closePaymentModal();
                            location.reload(); // تحديث الصفحة بعد نجاح العملية
                        }, 1000);
                    }
                })
                .catch(error => console.error("Something wrong:", error));
        });
    </script>

    <!-- Post Graduation Modal -->
    <script>
        function openPostGraduationModal(studentId) {
            document.getElementById('post_graduation_student_id').value = studentId;
            document.getElementById('postGraduationForm').reset(); // إعادة تعيين الحقول
            document.getElementById('responsePostGraduationMessage').innerHTML = ""; // مسح الرسائل السابقة
            document.getElementById('postGraduationModal').classList.remove('hidden');
        }

        function closePostGraduationModal() {
            document.getElementById('postGraduationForm').reset();
            document.getElementById('postGraduationModal').classList.add('hidden');
        }

        // Restore buttons
        document.getElementById('saveButtonWrapper').classList.remove('hidden');
        document.getElementById('loadingButtonWrapper').classList.add('hidden');

        document.getElementById('postGraduationForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Show loading spinner
            document.getElementById('saveButtonWrapper').classList.add('hidden');
            document.getElementById('loadingButtonWrapper').classList.remove('hidden');

            // احصل على جميع checkboxes
            document.querySelectorAll('#postGraduationForm input[type="checkbox"]').forEach(checkbox => {
                if (checkbox.checked) {
                    checkbox.value = "1"; // تحديد القيمة بـ 1 إذا كان محددًا
                } else {
                    checkbox.removeAttribute("name"); // إزالة الاسم حتى لا يتم إرساله
                }
            });

            const formData = new FormData(this);

            fetch("{{ route('admin.post-graduation.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Restore buttons
                    document.getElementById('saveButtonWrapper').classList.remove('hidden');
                    document.getElementById('loadingButtonWrapper').classList.add('hidden');

                    let PostGraduationMessageBox = document.getElementById('responsePostGraduationMessage');

                    if (data.success) {
                        PostGraduationMessageBox.innerHTML = `
                            <p class="text-green-600">${data.success}</p>
                            <p class="text-green-600">${data.message_2}</p>
                        `;

                        setTimeout(() => {
                            closePostGraduationModal();
                            location.reload();
                        }, 3000);
                    } else {
                        PostGraduationMessageBox.innerHTML =
                            `<p class="text-red-600">${data.error ?? __('An unexpected error occurred')}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('responsePostGraduationMessage').innerHTML =
                        `<p class="text-red-600">${__('Failed to submit the request, please try again later.')}</p>`;
                })
        });
    </script>
</div>
