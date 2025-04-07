<div>
    <div class="p-6">
        <div class="bg-white shadow-soft-xl rounded-2xl p-6">
            <!-- العنوان والزر في سطر واحد -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ __('Researches Management') }}</h2>

                <div class="flex justify-between items-center mb-4">
                    @if (Auth::user()->hasRole('admin'))
                        <div class="mx-3">
                            <a href="{{ route('admin.researches.create') }}"
                                class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition shadow-md hover:shadow-lg btn-bg">
                                {{ __('Add New Research') }}
                            </a>
                        </div>
                    @endif
                    <button wire:click="searchResearches" wire:loading.attr="disabled"
                        class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl shadow-md font-semibold
                                    hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                                    whitespace-nowrap btn-bg">
                        <span>{{ __('Search') }}</span>
                        <span wire:loading wire:target="searchResearches">
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
            </div>

            <!-- الحقول -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <input type="text" wire:model.defer="search.student_name"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="{{ __('Student Name') }}">

                <input type="text" wire:model.defer="search.title"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="{{ __('Research Title') }}">

                <input type="text" wire:model.defer="search.journal_name"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="{{ __('Journal Name') }}">

                <input type="date" wire:model.defer="search.publication_date"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <select wire:model.defer="search.status"
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('Status') }}</option>
                    <option value="published">{{ __('Published') }}</option>
                    <option value="accepted">{{ __('Accepted') }}</option>
                </select>
            </div>
        </div>

        <div class="bg-white shadow-soft-xl rounded-2xl p-6 my-10">
            <div class="overflow-x-auto rounded-lg">
                <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Research Title') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Student Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Journal Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Publication Date') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Status') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Department') }}</th>
                            @if (Auth::user()->hasRole('super-admin'))
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Added by') }}</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($researches as $research)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="p-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="p-4 text-sm text-gray-900">{{ $research->title }}</td>
                                <td class="p-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($research->student)
                                        {{ $research->student->full_name }}
                                    @else
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold whitespace-nowrap rounded-full bg-red-200 text-red-800">
                                            {{ __('Deleted student') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-900">{{ $research->journal_name }}</td>
                                <td class="p-4 text-sm text-gray-900">{{ $research->publication_date }}</td>
                                <td class="p-4 text-sm text-gray-900">
                                    <span
                                        class="px-3 py-1 rounded-full text-white {{ $research->status == 'published' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                        {{ $research->status == 'published' ? __('Published') : __('Accepted') }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-900">{{ $research->department->name }}</td>
                                @if (Auth::user()->hasRole('super-admin'))
                                    @isset($research->author->name)
                                        <td class="p-4 text-sm text-gray-900">{{ $research->author->name }}</td>
                                    @else
                                        <td class="p-4 text-sm text-gray-900">{{ __('Not Available') }}</td>
                                    @endisset
                                @endif
                                <td class="p-4 flex space-x-2">
                                    @if (isset($research->research_url))
                                        <a href="{{ $research->research_url }}" title="Download Research"
                                            class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition mx-2"
                                            target="_blank" download>
                                            {{ __('Download') }}
                                        </a>
                                    @else
                                        <a href="" title="Download Research"
                                            class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition mx-2 disabled"
                                            disabled="disabled">
                                            {{ __('Download') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->hasRole('super-admin'))
                                        <a href="{{ route('super-admin.researches.show', $research->id) }}"
                                            title="{{ __('Click to view details of this research') }}"
                                            class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg">
                                            {{ __('Show') }}
                                        </a>
                                    @else
                                        <button onclick="openDeleteModal({{ $research->id }})"
                                            title="{{ __('Click to delete this research') }}"
                                            class="bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                            {{ __('Delete') }}
                                        </button>
                                        <a href="{{ route('admin.researches.edit', $research->id) }}"
                                            title="{{ __('Click to edit this research') }}"
                                            class="bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-yellow-600 transition">
                                            {{ __('Edit') }}
                                        </a>
                                        <a href="{{ route('admin.researches.show', $research->id) }}"
                                            title="{{ __('Click to view details of this research') }}"
                                            class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 transition">
                                            {{ __('Show') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-center">
                {{ $researches->links() }}
            </div>
        </div>
    </div>



    @if (Auth::user()->hasRole('admin'))
        <!-- Modal for Confirming Delete -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
            style="background: #24262b26">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    {{ __('Are you sure you want to delete this Research?') }}
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
            function openDeleteModal(researchId) {
                // تحديث الرابط باستخدام البحث عن المعرف فقط
                const form = document.getElementById('deleteForm');
                form.action = `{{ route('admin.researches.destroy', ':id') }}`.replace(':id', researchId);

                // إظهار النافذة
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                // إخفاء النافذة
                document.getElementById('deleteModal').classList.add('hidden');
            }
        </script>
    @endif
</div>
