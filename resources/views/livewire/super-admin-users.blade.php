<div class="mx-3">
    <!-- نموذج البحث -->
    <div class="bg-white shadow-soft-xl rounded-2xl p-6 mx-3">
        <div class="flex flex-wrap items-center gap-4">

            <!-- زر البحث -->
            <div class="flex justify-center">
                <!-- زر البحث مع لودينق -->
                <button wire:click="getUsersProperty" wire:loading.attr="disabled"
                    class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl shadow-md font-semibold
                                    hover:bg-blue-800 transition duration-200 ease-in-out hover:shadow-lg
                                    whitespace-nowrap btn-bg">
                    <span>{{ __('Search') }}</span>
                    <span wire:loading wire:target="getUsersProperty">
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

            <!-- حقل الاسم -->
            <input type="text" wire:model="search.name"
                class="flex-1 min-w-[200px] border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-500"
                placeholder="{{ __('Name') }}">

            <!-- حقل البريد الإلكتروني -->
            <input type="email" wire:model="search.email"
                class="flex-1 min-w-[200px] border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-500"
                placeholder="{{ __('Email') }}">
        </div>
    </div>

    <div class="py-12 mx-3">
        <div class="bg-white overflow-hidden shadow-soft-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4 ">
                <a href="{{ route('super-admin.admins.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center gap-2 shadow-md btn-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>{{ __('Register User') }}</span>
                </a>
                <h1 class="font-bold mx-3">{{ __('Users') }}</h1>
            </div>
            <div>
                <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                #
                            </th>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                {{ __('Name') }}</th>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                {{ __('Email') }}</th>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                {{ __('Role') }}</th>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                {{ __('Department') }}</th>
                            <th
                                class="py-3 px-4 text-left text-sm font-medium text-gray-700 text-center uppercase tracking-wider">
                                {{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                    {{ $user->name }}
                                    @if (auth()->user()->id == $user->id)
                                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            {{ __('You') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">{{ $user->email }}</td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $role->name == 'super-admin' ? 'bg-blue-200 text-blue-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                    @if ($user->department)
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                            {{ $user->department->name }}
                                        </span>
                                    @elseif($user->role('super-admin'))
                                        <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-xs rounded-full">
                                            {{ __('All/View') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-700 text-center">
                                    <a href="{{ route('super-admin.admins.edit', ['id' => $user->id]) }}"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition mx-2">
                                        {{ __('Edit') }}
                                    </a>
                                    <button onclick="openDeleteModal({{ $user->id }})"
                                        class="bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                        {{ __('Delete') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Confirming Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-50 bg-opacity-10 flex items-center justify-center hidden"
        style="background: #24262b26">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Are you sure you want to delete this user?') }}
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
        function openDeleteModal(userId) {
            // Set the form action to delete the user
            const form = document.getElementById('deleteForm');
            form.action = '/panel/admin/' + userId;

            // Show the modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            // Hide the modal
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</div>
