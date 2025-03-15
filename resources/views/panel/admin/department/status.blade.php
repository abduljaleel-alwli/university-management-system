<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="px-3 py-6">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.students.show', $student->id) }}"
                                                class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg">{{ __('View') }}</a>
                                            <a href="{{ route('admin.students.edit', $student->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900">{{ __('Edit') }}</a>
                                            <button onclick="openDeleteModal({{ $student->id }})"
                                                class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            <button onclick="openPaymentModal({{ $student->id }})"
                                                class="text-green-600 hover:text-green-900">{{ __('Add Payment') }}</button>
                                            @if ($isPendingReview)
                                                <a href="{{ route('admin.post-graduation.show', $student->postGraduationStep->id) }}"
                                                    class="text-gray-600 hover:text-gray-900">{{ __('Complete') }}</a>
                                            @else
                                                <button onclick="openPostGraduationModal({{ $student->id }})"
                                                    class="text-green-600 hover:text-green-900">{{ __('Post Graduation') }}</button>
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
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">{{ __('Add New Payment') }}</h2>

            <form id="paymentForm">
                @csrf
                <input type="hidden" id="student_id" name="student_id">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Amount') }}</label>
                    <input type="number" id="amount" name="amount" class="w-full mt-1 p-2 border rounded-md"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Currency') }}</label>
                    <select id="currency" name="currency" class="w-full mt-1 p-2 border rounded-md">
                        <option value="IQD">{{ __('Iraqi Dinar') }}</option>
                        <option value="USD">{{ __('US Dollar') }}</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Payment Date') }}</label>
                    <input type="date" id="payment_date" name="payment_date"
                        class="w-full mt-1 p-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Notes') }}</label>
                    <textarea id="notes" name="notes" class="w-full mt-1 p-2 border rounded-md"></textarea>
                </div>

                <div id="responseMessage" class="mb-4 text-center"></div>

                <div class="flex justify-end">
                    <div class="bg-gray-400 px-4 py-2 rounded-md text-white mr-2">
                        <button type="button" class="w-full" onclick="closePaymentModal()">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="bg-blue-600 px-4 py-2 rounded-md text-white">
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
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">{{ __('Add Post Graduation Step') }}</h2>

            <form id="postGraduationForm">
                @csrf
                <input type="hidden" id="post_graduation_student_id" name="student_id" required>

                <div id="responsePostGraduationMessage" class="mb-4 text-center"></div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Discussion Date') }}</label>
                    <input type="date" id="discussion_date" name="discussion_date"
                        class="w-full mt-1 p-2 border rounded-md" required>
                </div>

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
                        <option value="graduate">{{ __('Graduate') }}</option>
                        <option value="fail">{{ __('Fail') }}</option>
                        <option value="pending_review">{{ __('Pending Review') }}</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <div class="bg-gray-400 px-4 py-2 rounded-md text-white mr-2">
                        <button type="button" class="w-full" onclick="closePostGraduationModal()">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="bg-blue-600 px-4 py-2 rounded-md text-white">
                        <button type="submit" class="w-full">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Confirming Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
        style="background: #24262b26">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
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
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-300">{{ __('Confirm') }}
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
                .catch(error => console.error("حدث خطأ:", error));
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

        document.getElementById('postGraduationForm').addEventListener('submit', function(event) {
            event.preventDefault();

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
                    let PostGraduationMessageBox = document.getElementById('responsePostGraduationMessage');

                    if (data.success) {
                        PostGraduationMessageBox.innerHTML = `<p class="text-green-600">${data.success}</p>`;
                        setTimeout(() => {
                            closePostGraduationModal();
                            location.reload();
                        }, 1000);
                    } else {
                        PostGraduationMessageBox.innerHTML =
                            `<p class="text-red-600">${data.error ?? __('An unexpected error occurred')}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('responsePostGraduationMessage').innerHTML =
                        `<p class="text-red-600">${__('Failed to submit the request, please try again later.')}</p>`;
                });
        });
    </script>

</x-app-layout>
