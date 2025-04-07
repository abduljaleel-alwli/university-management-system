<div class="p-6">

    <div class="bg-white shadow-soft-xl rounded-2xl p-6 max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('Post Graduation Steps') }}</h2>
            <button wire:click="searchData" wire:loading.attr="disabled"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out flex items-center gap-2 btn-bg">
                <span>{{ __('Search') }}</span>
                <span wire:loading wire:target="searchData">
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
            <input type="text" wire:model.defer="search.name" placeholder="{{ __('Student Name') }}..."
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <input type="date" wire:model.defer="search.discussion_date" placeholder="{{ __('Discussion Date') }}"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <input type="text" wire:model.defer="search.committee_decision"
                placeholder="{{ __('Committee Decision') }}"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <select wire:model.defer="search.clearance"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">{{ __('Clearance') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>

            <select wire:model.defer="search.sent_to_college"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">{{ __('Sent to College') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>

            <select wire:model.defer="search.sent_to_ministry"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">{{ __('Sent to Ministry') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>

            <select wire:model.defer="search.archived"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">{{ __('Archived') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">{{ __('No') }}</option>
            </select>

            <select wire:model.defer="search.post_graduation_status"
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">{{ __('Student Status') }}</option>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-soft-xl rounded-2xl p-6 my-12">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">#
                    </th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Student') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Discussion Date') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Committee Decision') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Department') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Student Status') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                        {{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($students as $step)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">
                            @if ($step->student)
                                {{ $step->student->full_name }}
                            @else
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold whitespace-nowrap rounded-full bg-red-200 text-red-800">
                                    {{ __('Deleted student') }}
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $step->discussion_date ?? __('Not specified') }}
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">
                            {{ $step->committee_decision ?? __('Not available') }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">
                            {{ $step->student->department->name ?? __('Not available') }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">
                            @if ($step->post_graduation_status === 'graduate')
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                    {{ __('Graduate') }}
                                </span>
                            @elseif ($step->post_graduation_status === 'fail')
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                    {{ __('Fail') }}
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ __('Pending Review') }}
                                </span>
                            @endif
                        </td>
                        @role('admin')
                            <td class="py-4 px-4 text-sm text-gray-700 flex space-x-2">
                                <a href="{{ route('admin.post-graduation.show', $step->id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-yellow-600 transition duration-200 mx-2"
                                    title="{{ __('View or Edit this Post Graduation Step') }}">
                                    {{ __('View/Edit') }}
                                </a>
                                <button onclick="openDeleteModal({{ $step->id }})"
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-red-600 transition duration-200"
                                    title="{{ __('Delete this Post Graduation Step') }}">
                                    {{ __('Delete') }}
                                </button>
                            </td>
                        @else
                            <td class="py-4 px-4 text-sm text-gray-700">
                                <a href="{{ route('super-admin.post-graduation.show', $step->id) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg"
                                    title="{{ __('View detailed information about this Post Graduation Step') }}">{{ __('View') }}</a>
                            </td>
                        @endrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-sm text-gray-700 text-center text-gray-500">
                            {{ __('No data available') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4 flex justify-center">
            {{ $students->links() }}
        </div>
    </div>


    <!-- Modal for Confirming Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
        style="background: #24262b26">
        <div class="bg-white p-6 rounded-lg shadow-soft-xl max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                {{ __('Are you sure you want to delete this Post Graduation for this student?') }}
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
            form.action = `/panel/post-graduation/${student_id}`;

            // Show the modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            // Hide the modal
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</div>
