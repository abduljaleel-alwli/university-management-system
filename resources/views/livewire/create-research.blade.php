<div class="px-6 ">
    <div class="my-6 mx-auto bg-white shadow-soft-xl rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Add New Research') }}</h1>
        <div>
            <label for="title_ar"
                class="pb-1 mt-3 block text-gray-700 font-medium mt-4 mb-2">{{ __('Research Title (Arabic)') }}</label>
            <input type="text" wire:model="title_ar" id="title_ar" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_ar')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="title_en"
                class="pb-1 mt-3 block text-gray-700 font-medium mb-2">{{ __('Research Title (English)') }}</label>
            <input type="text" wire:model="title_en" id="title_en" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_en')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="journal_name" class="pb-1 mt-3 block text-gray-700 font-medium mt-4 mb-2">{{ __('Journal Name') }}</label>
            <input type="text" wire:model="journal_name" id="journal_name" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('journal_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="journal_url" class="pb-1 mt-3 block text-gray-700 font-medium mt-4 mb-2">{{ __('Journal Link') }}</label>
            <input type="url" wire:model="journal_url" id="journal_url" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('journal_url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="publication_date"
                class="pb-1 mt-3 block text-gray-700 font-medium mb-2">{{ __('Publication Date') }}</label>
            <input type="date" wire:model="publication_date" id="publication_date" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('publication_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="research_url" class="pb-1 mt-3 block text-gray-700 font-medium mb-2">{{ __('Research Link') }}</label>
            <input type="url" wire:model="research_url" id="research_url" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('research_url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="notes" class="pb-1 mt-3 block text-gray-700 font-medium mb-2">{{ __('Note') }}</label>
            <textarea wire:model="notes" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                rows="4">{{ old('notes') }}</textarea>
            @error('notes')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="status" class="pb-1 mt-3 block text-gray-700 font-medium mt-4 mb-2">{{ __('Status') }}</label>
            <select wire:model="status" id="status" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">{{ __('Select Status') }}</option>
                <option value="published">{{ __('Published') }}</option>
                <option value="accepted">{{ __('Accepted') }}</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button wire:click="save"
            class="my-4 w-full bg-blue-600 text-white font-semibold p-3 rounded-lg hover:bg-blue-700 transition">
            {{ __('Create') }}
        </button>
    </div>


    <!-- نموذج البحث -->
    <div class="my-6 mx-auto bg-white shadow-soft-xl rounded-2xl p-6">
        <!-- نموذج البحث -->
        <div class="px-4 mb-6 pb-6"
            style="box-shadow: rgba(27, 31, 35, 0.04) 0px 1px 0px, rgba(255, 255, 255, 0.25) 0px 1px 0px inset;">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="block text-gray-700 font-medium mb-2">{{ __('Choose Student') }}</h1>
                    @error('student_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click="getStudentsProperty" wire:loading.attr="disabled"
                    class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl shadow-md font-semibold
                            hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                            whitespace-nowrap btn-bg">
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
                            <label for="pb-1 mt-3 status">{{ __('Status') }}</label>
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
                    <label for="pb-1 mt-3 start_date">{{ __('Start Date') }}</label>
                    <input type="date" wire:model="search.start_date"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                </div>
                <div>
                    <label for="pb-1 mt-3 study_end_date">{{ __('Study End Date') }}</label>
                    <input type="date" wire:model="search.study_end_date"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                </div>
            </div>
        </div>

        <div class="py-2 px-3">
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
