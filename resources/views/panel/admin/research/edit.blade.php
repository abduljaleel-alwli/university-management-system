<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Researche') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow-soft-xl rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">{{ __('Edit Research') }}</h1>
        <form action="{{ route('admin.researches.update', $research->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col space-y-2">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Student') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->student->full_name }}
                </div>
            </div>

            <div class="flex space-x-2">
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Research Title (Arabic)') }}</label>
                    <input type="text" name="title_ar" value="{{ old('title_ar', $research->title_ar) }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Research Title (English)') }}</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $research->title_en) }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex space-x-2">

                <div class="flex-2">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Journal Name') }}</label>
                    <input type="text" name="journal_name"
                        value="{{ old('journal_name', $research->journal_name) }}" required
                        class="w-full p-3 border bg-blue-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-2">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Journal Link') }}</label>
                    <input type="url" name="journal_url" value="{{ old('journal_url', $research->journal_url) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">{{ __('Research Link') }}</label>
                <input type="url" name="research_url" value="{{ old('research_url', $research->research_url) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex space-x-2">
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Publication Date') }}</label>
                    <input type="date" name="publication_date"
                        value="{{ old('publication_date', $research->publication_date) }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">{{ __('Status') }}</label>
                    <select name="status"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="published" {{ $research->status == 'published' ? 'selected' : '' }}>
                            {{ __('Published') }}</option>
                        <option value="accepted" {{ $research->status == 'accepted' ? 'selected' : '' }}>
                            {{ __('Accepted') }}</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">{{ __('Note') }}</label>
                <textarea name="notes" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    rows="4">{{ old('notes', $research->notes) }}</textarea>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-yellow-500 text-white font-semibold p-3 rounded-lg hover:bg-yellow-600 transition">
                    {{ __('Update') }}
                </button>
                <a href="{{ route('admin.researches.index') }}"
                    class="bg-gray-600 text-white font-semibold p-3 rounded-lg hover:bg-gray-700 transition">{{ __('Go Back') }}</a>
            </div>
        </form>

    </div>

</x-app-layout>
