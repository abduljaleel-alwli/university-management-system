<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students List') }}: {{ $department->name }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-soft-xl rounded-2xl px-5 py-4 mx-6">
        <div class="flex flex-wrap items-center gap-4 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students') }}: {{ $department->name }}
            </h2>

            <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg shadow-sm text-sm font-semibold">
                {{ __('Total Results') }}: <span class="text-blue-600">{{ $students->total() }}</span>
            </div>
        </div>
    </div>

    <div class="p-6 mb-6">
        <div class="bg-white shadow-soft-xl rounded-xl p-2 mb-6">
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
                                    {{ __('Status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Specialization Type') }}
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
                                        {{ $student->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $student->study_end_date }}</td>
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

</x-app-layout>
