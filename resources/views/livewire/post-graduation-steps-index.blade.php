<div class="p-6">

    <div class="bg-white shadow-soft-xl rounded-2xl p-6 max-w-5xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('Post Graduation Steps') }}</h2>

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

            <button wire:click="searchData"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 ease-in-out shadow-md hover:shadow-soft-xl btn-bg">
                {{ __('Search') }}
            </button>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-soft-xl rounded-2xl p-6 my-12">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">{{ __('Student') }}</th>
                    <th class="p-3 text-left">{{ __('Discussion Date') }}</th>
                    <th class="p-3 text-left">{{ __('Committee Decision') }}</th>
                    <th class="p-3 text-left">{{ __('Department') }}</th>
                    <th class="p-3 text-left">{{ __('Student Status') }}</th>
                    <th class="p-3 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($students as $step)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">{{ $step->student->first_name . ' ' . $step->student->last_name }}</td>
                        <td class="p-3">{{ $step->discussion_date ?? __('Not specified') }}</td>
                        <td class="p-3">{{ $step->committee_decision ?? __('Not available') }}</td>
                        <td class="p-3">{{ $step->student->department->name ?? __('Not available') }}</td>
                        <td class="p-3">
                            @if ($step->post_graduation_status === 'graduate')
                                <span class="text-green-600 font-medium">{{ __('Graduate') }}</span>
                            @elseif ($step->post_graduation_status === 'fail')
                                <span class="text-red-600 font-medium">{{ __('Fail') }}</span>
                            @else
                                <span class="text-yellow-600 font-medium">{{ __('Pending review') }}</span>
                            @endif
                        </td>
                        @role('admin')
                            <td class="p-3 flex space-x-2">
                                <a href="{{ route('admin.post-graduation.show', $step->id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-yellow-600 transition duration-200">
                                    {{ __('View/Edit') }}
                                </a>
                                <button onclick="openDeleteModal({{ $step->id }})"
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-red-600 transition duration-200">
                                    {{ __('Delete') }}
                                </button>
                            </td>
                        @else
                            <td class="p-3">
                                <a href="{{ route('super-admin.post-graduation.show', $step->id) }}"
                                    class="text-blue-500 hover:underline">{{ __('View') }}</a>
                            </td>
                        @endrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">{{ __('No data available') }}</td>
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
