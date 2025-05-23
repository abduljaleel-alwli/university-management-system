<div>
    <div class="bg-white p-8 mx-4 rounded-xl shadow-soft-xl py-6">
        <!-- العنوان -->
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center text-center">
            <svg class="w-6 h-6 mr-2 text-blue-500 mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                </path>
            </svg>
            {{ __('Send notification admin') }}
        </h2>

        <!-- رسائل التأكيد والأخطاء -->
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif(session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- حقل الرسالة -->
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">{{ __('Message') }}</label>
            <textarea wire:model="message" rows="4"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="{{ __('Write the message here') }}..."></textarea>
        </div>

        <!-- زر الإرسال -->
        <a href="#send"
            class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center btn-bg">
            <button wire:click="sendNotification" wire:loading.attr="disabled" class="w-full h-full">
                <span wire:loading.remove wire:target="sendNotification">{{ __('Send Notification') }}</span>
                <span wire:loading wire:target="sendNotification">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        </a>
    </div>

    <!-- اختيار الأدمن -->
    <div class="mb-6 mt-5 bg-white shadow-soft-xl rounded-2xl p-6 mx-4">
        <!-- نموذج البحث -->
        <div>
            <h1 class="block text-gray-700 font-medium mb-2">{{ __('Choose Admin') }}</h1>
            <div class="flex flex-wrap items-center gap-4">
                <!-- زر البحث -->
                <div class="flex justify-center">
                    <!-- زر البحث مع لودينق -->
                    <button wire:click="getUsersProperty" wire:loading.attr="disabled"
                        class="flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold
                        hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                        whitespace-nowrap btn-bg">
                        <span>{{ __('Search') }}</span>
                        <span wire:loading wire:target="getUsersProperty">
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
                </div>

                <!-- حقل الاسم -->
                <input type="text" wire:model="search.user_name"
                    class="flex-1 min-w-[200px] border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-500"
                    placeholder="{{ __('Name') }}">

                <!-- حقل البريد الإلكتروني -->
                <input type="email" wire:model="search.user_email"
                    class="flex-1 min-w-[200px] border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-500"
                    placeholder="{{ __('Email') }}">
            </div>
        </div>

        <div class="py-6 mx-3">
            <div>
                <div class="flex justify-between items-center mb-4 ">
                    <h1 class="font-bold mx-3">{{ __('Users') }}</h1>
                    <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg shadow-sm text-sm font-semibold">
                        {{ __('Total Results') }}: <span class="text-blue-600">{{ $admins->total() }}</span>
                    </div>
                </div>
                <div>
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    {{ __('Name') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    {{ __('Email') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    {{ __('Role') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    {{ __('Department') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                    {{ __('Chose') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($admins as $admin)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                        {{ $admin->name }}
                                        @if (auth()->user()->id == $admin->id)
                                            <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                                {{ __('You') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">{{ $admin->email }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                        @foreach ($admin->roles as $role)
                                            <span
                                                class="px-2 py-1 text-xs rounded-full {{ $role->name == 'super-admin' ? 'bg-blue-200 text-blue-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                        @if ($admin->department)
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                                {{ $admin->department->name }}
                                            </span>
                                        @elseif($admin->role('super-admin'))
                                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-xs rounded-full">
                                                {{ __('All/View') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                        <input id="admin_id_{{ $admin->id }}" type="radio"
                                            value="{{ $admin->id }}" wire:model="admin_id"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-6 bg-white shadow-soft-xl rounded-xl p-6 mb-6 mx-4">
        <!-- نموذج البحث -->
        <h1 class="block text-gray-700 font-medium mb-2">{{ __('Choose Student') }}</h1>
        <div class="mb-6">
            <div class="flex justify-between items-center mb-6">
                <!-- زر البحث مع لودينق -->
                <button wire:click="getStudentsProperty" wire:loading.attr="disabled"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out flex items-center gap-2 btn-bg">
                    <span>{{ __('Search') }}</span>
                    <span wire:loading wire:target="getStudentsProperty">
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
                    <label for="department_id" class="pb-2">{{ __('Department') }}</label>
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
                        <label for="status" class="pb-2">{{ __('Academic Stage') }}</label>
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
                        <label for="status" class="pb-2">{{ __('Status') }}</label>
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
                    <label for="start_date" class="pb-2">{{ __('Start Date') }}</label>
                    <input type="date" wire:model="search.start_date"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                </div>

                <!-- حقل تاريخ انتهاء الدراسة -->
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
            <div>
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
                                        {{ __('Department') }}
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
                                        {{ __('Chose') }}
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
                                            $student->status == 'pending_review' &&
                                            isset($student->postGraduationStep->id);

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
                                            {{ e($student->email) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $student->phone_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $student->department->name }}</td>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $student->specializationType->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <input id="student_id_{{ $student->id }}" type="radio"
                                                value="{{ $student->id }}" wire:model="student_id"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
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
</div>
