<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students List') }}: {{ $department->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- جدول عرض الطلاب -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('ID') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Name') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Email') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Phone Number') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Department') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-700">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $student->id }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $student->first_name }}
                                            {{ $student->father_name }} {{ $student->grandfather_name }}
                                            {{ $student->last_name }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $student->email }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $student->phone_number }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $student->department->name }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300">
                                            @if ($student->status == 'active')
                                                <span
                                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ __('Active') }}</span>
                                            @elseif ($student->status == 'suspended')
                                                <span
                                                    class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ __('Suspended') }}</span>
                                            @else
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ __('Pending Review') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300">
                                            <!-- زر عرض التفاصيل -->
                                            <a href="{{ route('super-admin.students.show', $student->id) }}"
                                                class="text-blue-500 hover:text-blue-700 mr-2">
                                                {{ __('View') }}
                                            </a>
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
    </div>

</x-app-layout>
