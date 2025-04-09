<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="px-3 py-6">
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

</x-app-layout>
