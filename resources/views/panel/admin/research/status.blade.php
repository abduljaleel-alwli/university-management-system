<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Researche List') }}
        </h2>
    </x-slot>


    <div class="p-6">
        <div class="bg-white shadow-soft-xl rounded-2xl p-6 my-10">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                @if ($status == 'published')
                    {{ __('Published Research') }}
                @elseif($status == 'accepted')
                    {{ __('Accepted Research') }}
                @endif
            </h1>
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
                                    {{ $research->student->full_name ?? '-' }}</td>
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
                                    <td class="p-4 text-sm text-gray-900">{{ $research->author->name }}</td>
                                @endif
                                <td class="p-4 flex space-x-2">
                                    @if (isset($research->research_url))
                                        <a href="{{ $research->research_url }}" title="download"
                                            class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition"
                                            target="_blank" download>
                                            {{ __('Download') }}
                                        </a>
                                    @else
                                        <a href="" title="download"
                                            class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-700 transition disabled"
                                            disabled="disabled">
                                            {{ __('Download') }}
                                        </a>
                                    @endif

                                    @if (Auth::user()->hasRole('super-admin'))
                                        <a href="{{ route('super-admin.researches.show', $research->id) }}"
                                            class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition btn-bg">
                                            {{ __('Show') }}
                                        </a>
                                    @else
                                        <button onclick="openDeleteModal({{ $research->id }})"
                                            class="bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                            {{ __('Delete') }}
                                        </button>
                                        <a href="{{ route('admin.researches.edit', $research->id) }}"
                                            class="bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-yellow-600 transition">
                                            {{ __('Edit') }}
                                        </a>
                                        <a href="{{ route('admin.researches.show', $research->id) }}"
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

</x-app-layout>
