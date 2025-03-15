<div x-data="{ isOpen: false }" class="relative">
    <!-- زر الإشعارات -->
    <button @click="isOpen = !isOpen"
        class="relative bg-gray-100 p-3 rounded-full focus:outline-none hover:bg-gray-200 transition duration-200 ease-in-out transform hover:scale-110">
        <!-- أيقونة الجرس -->
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    d="M18.7491 9.70957V9.00497C18.7491 5.13623 15.7274 2 12 2C8.27256 2 5.25087 5.13623 5.25087 9.00497V9.70957C5.25087 10.5552 5.00972 11.3818 4.5578 12.0854L3.45036 13.8095C2.43882 15.3843 3.21105 17.5249 4.97036 18.0229C9.57274 19.3257 14.4273 19.3257 19.0296 18.0229C20.789 17.5249 21.5612 15.3843 20.5496 13.8095L19.4422 12.0854C18.9903 11.3818 18.7491 10.5552 18.7491 9.70957Z"
                    stroke="#1C274C" stroke-width="1.5"></path>
                <path opacity="0.5" d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                <path opacity="0.5" d="M12 6V10" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
            </g>
        </svg>

        <!-- عداد الإشعارات -->
        <span x-show="{{ auth()->user()->unreadNotifications->count() > 0 }}"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-sm">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </button>

    <!-- قائمة الإشعارات -->
    <div wire:poll.15s x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 shadow-soft-xl rounded-2xl z-50 overflow-y-scroll
         overflow-x-hidden notifications-poup"
        style="min-height: 350px; max-height: 350px; overflow-x: hidden; overflow-y: scroll;">
        <div>
            <h3 class="text-lg font-bold text-gray-800 p-4">{{ __('Notifications') }}</h3>

            <!-- أزرار الفلترة -->
            <div class="flex space-x-2 px-4 py-2">
                <a href="#all" class="px-3 py-1 text-xs rounded-lg transition duration-200 ease-in-out"
                    :class="{ 'icon-active bg-blue-500 text-white': @js($filter === 'all'), 'bg-gray-100 text-gray-700 hover:bg-gray-200': @js($filter !== 'all') }">
                    <button wire:click="setFilter('all')" class="w-full">
                        {{ __('All') }}
                    </button>
                </a>
                <a href="#unread" class="px-3 py-1 text-xs rounded-lg transition duration-200 ease-in-out"
                    :class="{ 'icon-active bg-blue-500 text-white': @js($filter === 'unread'), 'bg-gray-100 text-gray-700 hover:bg-gray-200': @js($filter !== 'unread') }">
                    <button wire:click="setFilter('unread')">
                        {{ __('Unread') }}
                    </button>
                </a>
                <a href="#read" class="px-3 py-1 text-xs rounded-lg transition duration-200 ease-in-out"
                    :class="{ 'icon-active bg-blue-500 text-white': @js($filter === 'read'), 'bg-gray-100 text-gray-700 hover:bg-gray-200': @js($filter !== 'read') }">
                    <button wire:click="setFilter('read')">
                        {{ __('Readable') }}
                    </button>
                </a>
            </div>

            @if ($notifications->isEmpty())
                <p class="text-gray-600 text-sm text-center py-4">{{ __('No notifications.') }}</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($notifications as $notification)
                        {{-- Model --}}
                        @php
                            $student = \App\Models\Student::find($notification->data['student_id']);
                        @endphp

                        <li class="py-4 border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                            <div class="px-4">
                                <div class="space-y-2">
                                    @if (isset($notification->data['type']) && $notification->data['type'] === 'student-end-date')
                                        <a href="#" class="text-sm text-gray-800 hover:text-gray-900 font-medium">
                                            {{ __('The student study period ends') }}
                                            <strong
                                                class="text-blue-600">{{ $student ? $student->first_name . ' ' . $student->last_name : __('Unknown') }}</strong>
                                            {{ __('after 3 months.') }}
                                        </a>
                                        <div class="flex">

                                            @role('super-admin')
                                                @isset($notification->data['super-url'])
                                                    <a href="{{ $notification->data['super-url'] }}"
                                                        class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition btn-bg btn-bg">
                                                        {{ __('View Student') }}
                                                    </a>
                                                @endisset
                                            @else
                                                @isset($notification->data['url'])
                                                    <a href="{{ $notification->data['url'] }}"
                                                        class="inline-block bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                                        {{ __('View Student') }}
                                                    </a>
                                                @endisset
                                            @endrole
                                            @if (is_null($notification->read_at))
                                                <button wire:click="markAsRead('{{ $notification->id }}')"
                                                    class="bg-green-100 text-green-700 text-xs px-3 mx-2 py-1 rounded-lg hover:bg-green-200 transition flex items-center space-x-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M9 4.5C10 4.2 11 4 12 4C16.2 4 19 6.5 20.7 8.7C21.6 9.8 22 10.4 22 12C22 13.6 21.6 14.2 20.7 15.3C19 17.5 16.2 20 12 20C7.8 20 5 17.5 3.3 15.3C2.4 14.2 2 13.6 2 12C2 10.4 2.4 9.8 3.3 8.7C3.8 8.1 4.3 7.5 5 6.8"
                                                            stroke="#1C274C" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                        <path
                                                            d="M15 12C15 13.7 13.7 15 12 15C10.3 15 9 13.7 9 12C9 10.3 10.3 9 12 9C13.7 9 15 10.3 15 12Z"
                                                            stroke="#1C274C" stroke-width="1.5" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    @elseif(isset($notification->data['type']) && $notification->data['type'] === 'post-graduation')
                                        <a href="#" class="text-sm text-gray-800 hover:text-gray-900 font-medium">
                                            {{ __('A graduation discussion has been created for the student') }}
                                            <strong
                                                class="text-blue-600">{{ $student ? $student->first_name . ' ' . $student->last_name : 'غير معروف' }}</strong>
                                            {{ __('Please complete the procedure.') }}
                                        </a>
                                        <div class="mt-2 space-x-1 flex">
                                            @role('super-admin')
                                                @isset($notification->data['students-super-url'])
                                                    <a href="{{ $notification->data['students-super-url'] }}"
                                                        class="bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition btn-bg"
                                                        style="margin: 0 5px">
                                                        {{ __('View Student') }}
                                                    </a>
                                                @endisset
                                                @isset($notification->data['graduation-super-url'])
                                                    <a href="{{ $notification->data['graduation-super-url'] }}"
                                                        class="bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition btn-bg"
                                                        style="margin: 0 5px">
                                                        {{ __('View Graduation') }}
                                                    </a>
                                                @endisset
                                            @else
                                                @isset($notification->data['students-url'])
                                                    <a href="{{ $notification->data['students-url'] }}"
                                                        class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                                        style="margin: 0 5px">
                                                        {{ __('View Student') }}
                                                    </a>
                                                @endisset
                                                @isset($notification->data['graduation-url'])
                                                    <a href="{{ $notification->data['graduation-url'] }}"
                                                        class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                                        style="margin: 0 5px">
                                                        {{ __('View Discussion') }}
                                                    </a>
                                                @endisset
                                            @endrole

                                            @if (is_null($notification->read_at))
                                                <button wire:click="markAsRead('{{ $notification->id }}')"
                                                    class="bg-green-100 text-green-700 text-xs px-3 mx-2 py-1 rounded-lg hover:bg-green-200 transition flex items-center space-x-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M9 4.5C10 4.2 11 4 12 4C16.2 4 19 6.5 20.7 8.7C21.6 9.8 22 10.4 22 12C22 13.6 21.6 14.2 20.7 15.3C19 17.5 16.2 20 12 20C7.8 20 5 17.5 3.3 15.3C2.4 14.2 2 13.6 2 12C2 10.4 2.4 9.8 3.3 8.7C3.8 8.1 4.3 7.5 5 6.8"
                                                            stroke="#1C274C" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                        <path
                                                            d="M15 12C15 13.7 13.7 15 12 15C10.3 15 9 13.7 9 12C9 10.3 10.3 9 12 9C13.7 9 15 10.3 15 12Z"
                                                            stroke="#1C274C" stroke-width="1.5" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        @role('admin')
                                            <div
                                                class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-md inline-block">
                                                {{ __('From Super Admin') }}
                                            </div>
                                            <div>
                                                <a href="#"
                                                    class="block text-sm text-gray-800 hover:text-gray-900 font-medium mt-2">
                                                    {{ $notification->data['message'] }}
                                                </a>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ __('Student') }}:
                                                    <strong>{{ $student ? $student->first_name . ' ' . $student->last_name : __('Unknown') }}</strong>
                                                </p>
                                            </div>
                                            <div class="flex">
                                                <a href="/panel/students/{{ $student->id }}"
                                                    class="inline-block bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                                    {{ __('View Student') }}
                                                </a>

                                                @if (is_null($notification->read_at))
                                                    <button wire:click="markAsRead('{{ $notification->id }}')"
                                                        class="bg-green-100 text-green-700 text-xs px-3 mx-2 py-1 rounded-lg hover:bg-green-200 transition flex items-center space-x-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M9 4.5C10 4.2 11 4 12 4C16.2 4 19 6.5 20.7 8.7C21.6 9.8 22 10.4 22 12C22 13.6 21.6 14.2 20.7 15.3C19 17.5 16.2 20 12 20C7.8 20 5 17.5 3.3 15.3C2.4 14.2 2 13.6 2 12C2 10.4 2.4 9.8 3.3 8.7C3.8 8.1 4.3 7.5 5 6.8"
                                                                stroke="#1C274C" stroke-width="1.5"
                                                                stroke-linecap="round" />
                                                            <path
                                                                d="M15 12C15 13.7 13.7 15 12 15C10.3 15 9 13.7 9 12C9 10.3 10.3 9 12 9C13.7 9 15 10.3 15 12Z"
                                                                stroke="#1C274C" stroke-width="1.5" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        @endrole
                                    @endif
                                </div>

                            </div>
                            <p class="text-xs text-gray-500 mt-2 px-4">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-5 px-4 mb-3">
                    <!-- روابط التنقل بين الصفحات -->
                    <div class="text-gray-600">
                        {{ $notifications->links() }}
                    </div>

                    <!-- زر تحديد الكل كمقروء -->
                    <div class="mt-4 flex justify-center">
                        <button wire:click="markAllAsRead"
                            class="bg-blue-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200 transform focus:outline-none focus:ring-2 focus:ring-blue-400 btn-bg">
                            {{ __('Mark all as read') }}
                        </button>
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
