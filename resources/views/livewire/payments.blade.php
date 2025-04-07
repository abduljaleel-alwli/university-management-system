<div class="p-6">

    <!-- حقول البحث -->
    <div class="bg-white shadow-soft-xl rounded-2xl p-6">
        <!-- العنوان والزر في سطر واحد -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">{{ __('Payments Management') }}</h2>
            <button wire:click="searchPayments" wire:loading.attr="disabled"
                class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 shadow-md rounded-xl font-semibold
                            hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                            whitespace-nowrap btn-bg">
                <span>{{ __('Search') }}</span>
                <span wire:loading wire:target="searchPayments">
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

        <!-- الحقول -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" wire:model.defer="search.student_name"
                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="{{ __('Search by Student Name') }}">

            <input type="text" wire:model.defer="search.receipt_number"
                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="{{ __('Search by Receipt Number') }}">

            <input type="date" wire:model.defer="search.payment_date"
                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select wire:model.defer="search.currency"
                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">{{ __('All Currencies') }}</option>
                <option value="IQD">{{ __('IQD') }}</option>
                <option value="USD">{{ __('USD') }}</option>
            </select>
        </div>
    </div>

    <div class="bg-white shadow-soft-xl rounded-2xl p-6 my-10">
        <div class="overflow-x-auto rounded-lg">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Receipt Number') }}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Student Name') }}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Amount') }}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Currency') }}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Payment Date') }}</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Department') }}</th>
                        @if (Auth::user()->hasRole('super-admin'))
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Added by') }}</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Last modified by') }}</th>
                        @endif
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($payments as $payment)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="p-4 text-sm text-gray-900 whitespace-nowrap">{{ $payment->receipt_number }}</td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($payment->student)
                                    {{ $payment->student->full_name }}
                                @else
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold whitespace-nowrap rounded-full bg-red-200 text-red-800">
                                        {{ __('Deleted student') }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-900">{{ $payment->amount }}</td>
                            <td class="p-4 text-sm text-gray-900">
                                {{ $payment->currency == 'IQD' ? __('IQD') : __('USD') }}</td>
                            <td class="p-4 text-sm text-gray-900">{{ $payment->payment_date }}</td>
                            <td class="p-4 text-sm text-gray-900">{{ $payment->department->name }}</td>
                            @if (Auth::user()->hasRole('super-admin'))
                                <td class="p-4 text-sm text-gray-900">
                                    @if ($payment->author)
                                        {{ $payment->author->name }}
                                    @else
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold whitespace-nowrap rounded-full bg-red-200 text-red-800">
                                            {{ __('Deleted user') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-900">
                                    {{ $payment->editor ? $payment->editor->name : __('Not modified') }}
                                </td>
                            @endif
                            <td class="p-4">
                                <div class="flex space-x-4 whitespace-nowrap">
                                    @role('admin')
                                        <a href="{{ route('admin.payments.show', $payment->id) }}"
                                            class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg mx-2"
                                            title="{{ __('View or Edit this payment') }}">{{ __('View/Edit') }}</a>
                                        <button
                                            class="bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition"
                                            onclick="openDeleteModal({{ $payment->id }})"
                                            title="{{ __('Delete this payment') }}">{{ __('Delete') }}</button>
                                    @elseif('super-admin')
                                        <a href="{{ route('super-admin.payments.show', $payment->id) }}"
                                            class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg"
                                            title="{{ __('View this payment') }}">{{ __('View') }}</a>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-center">
            {{ $payments->links() }}
        </div>
    </div>


    @if (Auth::user()->hasRole('admin'))
        <!-- Modal for Confirming Delete -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
            style="background: #24262b26">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    {{ __('Are you sure you want to delete this payment?') }}
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
            function openDeleteModal(post_graduation) {
                // Set the form action to delete the user
                const form = document.getElementById('deleteForm');
                form.action = `{{ route('admin.payments.destroy', ':id') }}`.replace(':id', post_graduation);

                // Show the modal
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                // Hide the modal
                document.getElementById('deleteModal').classList.add('hidden');
            }
        </script>
    @endif
</div>
