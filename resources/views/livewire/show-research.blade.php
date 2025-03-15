<div class="p-6">
    <div class="mx-auto bg-white shadow-soft-xl rounded-2xl overflow-hidden p-8 space-y-8">
        <div class="flex justify-between items-center pb-2">
            <!-- العنوان في اليسار -->
            <h2 class="text-2xl font-bold text-gray-800">{{ __('Research Details') }}</h2>

            <!-- الأزرار في اليمين -->
            <div class="flex space-x-2">
                @role('super-admin')
                    <a href="{{ route('super-admin.researches.index') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        {{ __('Go Back') }}
                    </a>
                @elseif('admin')
                    <a href="{{ route('admin.researches.index') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        {{ __('Go Back') }}
                    </a>
                    <a href="{{ route('admin.researches.edit', $research->id) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        {{ __('Edit') }}
                    </a>
                @endrole
            </div>
        </div>

        <!-- تفاصيل البحث باستخدام Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @role('super-admin')
                <!-- البحث بالعربية -->
                <div class="flex flex-col space-y-2">
                    <label class="text-sm font-medium text-gray-500">{{ __('Added by') }}</label>
                    <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                        <span class="px-3 py-1 rounded-full text-white bg-green-500">
                            {{ $research->author->name }}
                        </span>
                    </div>
                </div>

                <!-- البحث بالإنجليزية -->
                <div class="flex flex-col space-y-2">
                    <label class="text-sm font-medium text-gray-500">{{ __('Last modified by') }}</label>
                    <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                        @if (isset($research->editor->name))
                            <span class="px-3 py-1 rounded-full text-white bg-yellow-500">
                                {{ $research->editor->name }}
                            </span>
                        @else
                            <span class="text-gray-400">{{ __('Not modified') }}</span>
                        @endif
                    </div>
                </div>
            @endrole

            <!-- البحث بالعربية -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Research Title (Arabic)') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->title_ar }}
                </div>
            </div>

            <!-- البحث بالإنجليزية -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Research Title (English)') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->title_en }}
                </div>
            </div>

            <!-- اسم الطالب -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Student') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->student->first_name }} {{ $research->student->last_name }}
                </div>
            </div>

            <!-- القسم -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Department') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->department->name }}
                </div>
            </div>

            <!-- اسم المجلة -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Journal Name') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->journal_name }}
                </div>
            </div>

            <!-- رابط المجلة -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Journal Link') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg">
                    <a href="{{ $research->journal_url }}"
                        class="text-blue-600 hover:text-blue-700 transition duration-300" target="_blank">
                        {{ __('View Journal') }}
                    </a>
                </div>
            </div>

            <!-- تاريخ النشر -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Publication Date') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    {{ $research->publication_date }}
                </div>
            </div>

            <!-- رابط البحث -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Research Link') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg">
                    @if (isset($research->research_url))
                        <a href="{{ $research->research_url }}"
                            class="inline-flex items-center justify-center bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition duration-300"
                            target="_blank" download>
                            {{ __('Download') }}
                        </a>
                    @else
                        <span class="text-gray-400">{{ __('No Research link available') }}</span>
                    @endif
                </div>
            </div>

            <!-- الملاحظات -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Note') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg text-gray-800">
                    @if (isset($research->research_url))
                        {{ $research->notes }}
                    @else
                        <span class="text-gray-400">{{ __('No Note') }}</span>
                    @endif
                </div>
            </div>

            <!-- الحالة -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-medium text-gray-500">{{ __('Status') }}</label>
                <div class="p-3 bg-blue-50 border border-gray-200 rounded-lg">
                    <span
                        class="px-3 py-1 rounded-full text-white
                    {{ $research->status == 'published' ? 'bg-blue-500' : 'bg-yellow-500' }}">
                        {{ $research->status == 'published' ? __('Published') : __('Accepted') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- بيانات الطالب -->
    <div class="bg-white shadow-soft-xl rounded-2xl p-6 my-10">
        <h2 class="text-2xl font-bold text-gray-800 pb-6">{{ __('Student Details') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $fields = [
                    'first_name_ar' => __('First Name (Arabic)'),
                    'first_name_en' => __('First Name (English)'),
                    'father_name_ar' => __('Father Name (Arabic)'),
                    'father_name_en' => __('Father Name (English)'),
                    'grandfather_name_ar' => __('Grandfather Name (Arabic)'),
                    'grandfather_name_en' => __('Grandfather Name (English)'),
                    'last_name_ar' => __('Last Name (Arabic)'),
                    'last_name_en' => __('Last Name (English)'),
                    'email' => __('Email'),
                    'phone_number' => __('Phone Number'),
                ];
            @endphp

            @foreach ($fields as $key => $label)
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                    <div class="mt-1 p-2 bg-blue-50 rounded-lg">
                        <p class="text-gray-900">{{ $research->student->$key }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @role('admin')
            <div class="flex">
                <a href="{{ route('admin.students.show', ['student' => $research->student->id]) }}"
                    class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                    {{ __('View') }}
                </a>
                <a href="{{ route('admin.students.edit', ['student' => $research->student->id]) }}"
                    class="mx-2 block bg-yellow-400 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-yellow-500 transition">
                    {{ __('Edit') }}
                </a>
            </div>
        @elseif('super-admin')
            <a href="{{ route('super-admin.students.show', ['student' => $research->student->id]) }}"
                class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center mt-4 hover:bg-blue-700 transition btn-bg">
                {{ __('View') }}
            </a>
        @endrole
    </div>
</div>
