<!-- sidenav  -->
<aside
    class="sidebar-box max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4
    block w-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased
    transition-transform duration-200 xl:translate-x-0 xl:bg-white shadow-soft-xl
    {{ isRtl() ? 'sidebar-rtl ' : 'sidebar-ltr ' }}">

    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('panel') }}">
            @include('components.application-logo')
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">{{ $settings->site_name }}</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div style="height: 100%; padding-bottom: 100px;"
        class="sidebar-items items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="sidebar-item mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4  transition-colors"
                    href="{{ route('panel') }}">
                    <div
                        class="sidebar-item-icon-box {{ isActiveIcon('panel', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M9.44661 15.3975C9.11385 15.1508 8.64413 15.2206 8.39748 15.5534C8.15082 15.8862 8.22062 16.3559 8.55339 16.6025C9.5258 17.3233 10.715 17.75 12 17.75C13.285 17.75 14.4742 17.3233 15.4466 16.6025C15.7794 16.3559 15.8492 15.8862 15.6025 15.5534C15.3559 15.2206 14.8862 15.1508 14.5534 15.3975C13.825 15.9373 12.9459 16.25 12 16.25C11.0541 16.25 10.175 15.9373 9.44661 15.3975Z"
                                    fill="#1C274C"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 1.25C11.2919 1.25 10.6485 1.45282 9.95055 1.79224C9.27585 2.12035 8.49642 2.60409 7.52286 3.20832L5.45628 4.4909C4.53509 5.06261 3.79744 5.5204 3.2289 5.95581C2.64015 6.40669 2.18795 6.86589 1.86131 7.46263C1.53535 8.05812 1.38857 8.69174 1.31819 9.4407C1.24999 10.1665 1.24999 11.0541 1.25 12.1672V13.7799C1.24999 15.6837 1.24998 17.1866 1.4027 18.3616C1.55937 19.567 1.88856 20.5401 2.63236 21.3094C3.37958 22.0824 4.33046 22.4277 5.50761 22.5914C6.64849 22.75 8.10556 22.75 9.94185 22.75H14.0581C15.8944 22.75 17.3515 22.75 18.4924 22.5914C19.6695 22.4277 20.6204 22.0824 21.3676 21.3094C22.1114 20.5401 22.4406 19.567 22.5973 18.3616C22.75 17.1866 22.75 15.6838 22.75 13.7799V12.1672C22.75 11.0541 22.75 10.1665 22.6818 9.4407C22.6114 8.69174 22.4646 8.05812 22.1387 7.46263C21.8121 6.86589 21.3599 6.40669 20.7711 5.95581C20.2026 5.5204 19.4649 5.06262 18.5437 4.49091L16.4771 3.20831C15.5036 2.60409 14.7241 2.12034 14.0494 1.79224C13.3515 1.45282 12.7081 1.25 12 1.25ZM8.27953 4.50412C9.29529 3.87371 10.0095 3.43153 10.6065 3.1412C11.1882 2.85833 11.6002 2.75 12 2.75C12.3998 2.75 12.8118 2.85833 13.3935 3.14119C13.9905 3.43153 14.7047 3.87371 15.7205 4.50412L17.7205 5.74537C18.6813 6.34169 19.3559 6.76135 19.8591 7.1467C20.3487 7.52164 20.6303 7.83106 20.8229 8.18285C21.0162 8.53589 21.129 8.94865 21.1884 9.58104C21.2492 10.2286 21.25 11.0458 21.25 12.2039V13.725C21.25 15.6959 21.2485 17.1012 21.1098 18.1683C20.9736 19.2163 20.717 19.8244 20.2892 20.2669C19.8649 20.7058 19.2871 20.9664 18.2858 21.1057C17.2602 21.2483 15.9075 21.25 14 21.25H10C8.09247 21.25 6.73983 21.2483 5.71422 21.1057C4.71286 20.9664 4.13514 20.7058 3.71079 20.2669C3.28301 19.8244 3.02642 19.2163 2.89019 18.1683C2.75149 17.1012 2.75 15.6959 2.75 13.725V12.2039C2.75 11.0458 2.75076 10.2286 2.81161 9.58104C2.87103 8.94865 2.98385 8.53589 3.17709 8.18285C3.36965 7.83106 3.65133 7.52164 4.14092 7.1467C4.6441 6.76135 5.31869 6.34169 6.27953 5.74537L8.27953 4.50412Z"
                                    fill="#1C274C"></path>
                            </g>
                        </svg>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Dashboard') }}</span>
                </a>
            </li>

            <li class="sidebar-item mt-0.5 w-full">
                <div class="cursor-pointer py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:text-blue-500"
                    onclick="toggleAccordion('departments')">
                    <div
                        class="sidebar-item-icon-box {{ isActiveIcon('super-admin.departments.status', 'icon-active-4') }} {{ isActiveIcon('admin.departments.status', 'icon-active-4') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <!-- أيقونة القسم -->
                        <svg width="35px" height="35px" viewBox="0 0 24 24" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>group_line</title>
                                <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Development" transform="translate(-768.000000, 0.000000)">
                                        <g id="group_line" transform="translate(768.000000, 0.000000)">
                                            <path
                                                d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z"
                                                id="MingCute" fill-rule="nonzero"> </path>
                                            <path
                                                d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z"
                                                id="形状" fill="#09244B"> </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Departments') }}</span>
                    <svg id="arrow-departments" class="ml-auto h-4 w-4 transform transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>

                <ul class="bg-gray-100 p-4 rounded-lg hidden mt-0.5 w-full mx-4" id="departments">
                    <!-- Super Admin Nave Links -->
                    @role('super-admin')

                        @foreach ($departments as $department)
                            <li class="sidebar-item mt-0.5 w-full">
                                <div class="cursor-pointer py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:text-blue-500"
                                    onclick="toggleAccordion('department-{{ $department->id }}')">
                                    <div
                                        class="sidebar-item-icon-box shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                        <!-- أيقونة القسم -->
                                        <svg width="35px" height="35px" viewBox="0 0 24 24" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>group_line</title>
                                                <g id="页面-1" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="Development" transform="translate(-768.000000, 0.000000)">
                                                        <g id="group_line" transform="translate(768.000000, 0.000000)">
                                                            <path
                                                                d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z"
                                                                id="MingCute" fill-rule="nonzero"> </path>
                                                            <path
                                                                d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z"
                                                                id="形状" fill="#09244B"> </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ $department->name }}</span>
                                    <svg id="arrow-{{ $department->id }}"
                                        class="ml-auto h-4 w-4 transform transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>

                                <ul id="department-{{ $department->id }}"
                                    class="hidden max-w-md space-y-2 p-4 bg-white rounded-lg">
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('super-admin.departments.status', ['department' => $department->id, 'status' => 'active']) }}">
                                            <span class="flex-1">{{ __('Continuing students') }}</span>
                                            <span
                                                class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-200 text-blue-800">
                                                {{ $department->activeStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('super-admin.departments.status', ['department' => $department->id, 'status' => 'fail']) }}">
                                            <span class="flex-1">{{ __('Students failing') }}</span>
                                            <span
                                                class="ml-2 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-200 text-red-800">
                                                {{ $department->failedStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('super-admin.departments.status', ['department' => $department->id, 'status' => 'graduate']) }}">
                                            <span class="flex-1">{{ __('Graduate students') }}</span>
                                            <span
                                                class="ml-2 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-green-200 text-green-800">
                                                {{ $department->graduatedStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @endrole

                    <!-- Admin Nave Links -->
                    @role('admin')
                        <!-- Departments -->
                        @foreach ($departments as $department)
                            <li class="sidebar-item mt-0.5 w-full">
                                <div class="cursor-pointer py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:text-blue-500"
                                    onclick="toggleAccordion('department-{{ $department->id }}')">
                                    <div
                                        class="sidebar-item-icon-box shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                                        <!-- أيقونة القسم -->
                                        <svg width="35px" height="35px" viewBox="0 0 24 24" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>group_line</title>
                                                <g id="页面-1" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="Development" transform="translate(-768.000000, 0.000000)">
                                                        <g id="group_line" transform="translate(768.000000, 0.000000)">
                                                            <path
                                                                d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z"
                                                                id="MingCute" fill-rule="nonzero"> </path>
                                                            <path
                                                                d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z"
                                                                id="形状" fill="#09244B"> </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ $department->name }}</span>
                                    <svg id="arrow-{{ $department->id }}"
                                        class="ml-auto h-4 w-4 transform transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>

                                <ul id="department-{{ $department->id }}"
                                    class="hidden max-w-md space-y-2 p-4 bg-white rounded-lg">
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('admin.departments.status', ['department' => $department->id, 'status' => 'active']) }}">
                                            <span class="flex-1">{{ __('Continuing students') }}</span>
                                            <span
                                                class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-200 text-blue-800">
                                                {{ $department->activeStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('admin.departments.status', ['department' => $department->id, 'status' => 'fail']) }}">
                                            <span class="flex-1">{{ __('Students failing') }}</span>
                                            <span
                                                class="ml-2 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-200 text-red-800">
                                                {{ $department->failedStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                                        <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                            href="{{ route('admin.departments.status', ['department' => $department->id, 'status' => 'graduate']) }}">
                                            <span class="flex-1">{{ __('Graduate students') }}</span>
                                            <span
                                                class="ml-2 bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-green-200 text-green-800">
                                                {{ $department->graduatedStudents()->count() }}
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @endrole
                </ul>
            </li>


            <!-- Super Admin Nave Links -->
            @role('super-admin')
                <!-- Specializations -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4  transition-colors"
                        href="{{ route('super-admin.specializations.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.specializations.index', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                                        fill="#1C274C"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Specializations') }}</span>
                    </a>
                </li>

                <!-- Departments -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class=" py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.departments.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon(['super-admin.departments.index', 'super-admin.departments.show'], 'icon-active-3') }}  shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg fill="#09244B" xmlns="http://www.w3.org/2000/svg" width="35px" height="35px"
                                viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M47.6,29.2h-8c-1.3,0-2.4-1.1-2.4-2.4v-1.6 c0-1.3,1.1-2.4,2.4-2.4h8c1.3,0,2.4,1.1,2.4,2.4v1.6C50,28.1,48.9,29.2,47.6,29.2">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M30,29.2h-8c-1.3,0-2.4-1.1-2.4-2.4v-1.6 c0-1.3,1.1-2.4,2.4-2.4h8c1.3,0,2.4,1.1,2.4,2.4v1.6C32.4,28.1,31.3,29.2,30,29.2">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.4,29.2h-8C3,29.2,2,28.1,2,26.8v-1.6 c0-1.3,1.1-2.4,2.4-2.4h8c1.3,0,2.4,1.1,2.4,2.4v1.6C14.8,28.1,13.7,29.2,12.4,29.2">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M43.6,34H8.4c-1.8,0-3.2,1.4-3.2,3.2v8c0,1.8,1.4,3.2,3.2,3.2h35.2 c1.8,0,3.2-1.4,3.2-3.2v-8C46.8,35.4,45.3,34,43.6,34z M42,42.8c0,0.4-0.4,0.8-0.8,0.8H10.8c-0.4,0-0.8-0.4-0.8-0.8v-3.2 c0-0.4,0.4-0.8,0.8-0.8h30.4c0.4,0,0.8,0.4,0.8,0.8V42.8z">
                                    </path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M43.6,3.6H8.4C6.6,3.6,5.2,5,5.2,6.8v8c0,1.8,1.4,3.2,3.2,3.2h35.2 c1.8,0,3.2-1.4,3.2-3.2v-8C46.8,5,45.3,3.6,43.6,3.6z M42,12.4c0,0.4-0.4,0.8-0.8,0.8H10.8c-0.4,0-0.8-0.4-0.8-0.8V9.2 c0-0.4,0.4-0.8,0.8-0.8h30.4c0.4,0,0.8,0.4,0.8,0.8V12.4z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Departments') }}</span>
                    </a>
                </li>

                <!-- Students -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.students.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.students.*', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg fill="#09244B" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                viewBox="0 0 31.716 31.716" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path
                                            d="M30.604,14.503v-3.815c0.709-0.606,1.112-1.479,1.112-2.416c0-1.322-0.832-2.52-2.069-2.98l-11.44-4.259 c-1.549-0.577-3.275-0.574-4.821,0.007L2.062,5.294C0.829,5.757,0,6.954,0,8.271c0,1.318,0.83,2.514,2.062,2.976l4.236,1.591 l0.005,3.199c-0.091,0.939-0.76,7.993,3.183,12.388c1.601,1.783,3.729,2.688,6.32,2.688c2.593,0,4.718-0.905,6.319-2.688 c4.014-4.474,3.248-11.748,3.18-12.434l0.004-3.126l3.68-1.37v3.008c-0.545,0.395-0.892,1.165-0.892,2.014 c0,1.123,0,2.284,1.697,2.284c1.698,0,1.698-1.162,1.698-2.284C31.494,15.669,31.15,14.898,30.604,14.503z M20.645,27.095 c-1.226,1.364-2.809,2.026-4.838,2.026c-2.031,0-3.611-0.664-4.836-2.026c-2.157-2.397-2.675-5.208-2.754-7.96 c1.834,1.184,4.739,1.792,7.587,1.792c2.853,0,5.761-0.61,7.593-1.802C23.318,21.879,22.804,24.695,20.645,27.095z M8.775,16.187 v-2.418l4.611,1.733c1.545,0.582,3.273,0.583,4.822,0.008l4.628-1.723v2.4c0,0.774-2.737,2.256-7.03,2.256 S8.775,16.961,8.775,16.187z M26.527,9.393l-9.547,3.554c-0.756,0.283-1.603,0.281-2.36-0.003L5.165,9.392 c-0.084-0.031-0.19-0.068-0.307-0.107c-0.542-0.18-1.552-0.518-1.552-1.014c0-0.505,0.963-0.822,1.538-1.011 c0.123-0.04,0.232-0.077,0.321-0.11l9.454-3.552C15,3.454,15.398,3.383,15.804,3.383c0.404,0,0.798,0.071,1.176,0.211l9.549,3.555 c0.078,0.029,0.172,0.062,0.277,0.097c0.52,0.178,1.602,0.544,1.602,1.025C28.408,8.466,28.091,8.815,26.527,9.393z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Students') }}</span>
                    </a>
                </li>

                <!-- Admins -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.admins.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.admins.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <circle cx="12" cy="6" r="4" stroke="#1C274C" stroke-width="1.5">
                                    </circle>
                                    <path
                                        d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Users') }}</span>
                    </a>
                </li>

                <!-- Manage Notifications -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.notifications.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.notifications.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M12.02 2.90991C8.70997 2.90991 6.01997 5.59991 6.01997 8.90991V11.7999C6.01997 12.4099 5.75997 13.3399 5.44997 13.8599L4.29997 15.7699C3.58997 16.9499 4.07997 18.2599 5.37997 18.6999C9.68997 20.1399 14.34 20.1399 18.65 18.6999C19.86 18.2999 20.39 16.8699 19.73 15.7699L18.58 13.8599C18.28 13.3399 18.02 12.4099 18.02 11.7999V8.90991C18.02 5.60991 15.32 2.90991 12.02 2.90991Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round"></path>
                                    <path
                                        d="M13.87 3.19994C13.56 3.10994 13.24 3.03994 12.91 2.99994C11.95 2.87994 11.03 2.94994 10.17 3.19994C10.46 2.45994 11.18 1.93994 12.02 1.93994C12.86 1.93994 13.58 2.45994 13.87 3.19994Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M15.02 19.0601C15.02 20.7101 13.67 22.0601 12.02 22.0601C11.2 22.0601 10.44 21.7201 9.90002 21.1801C9.36002 20.6401 9.02002 19.8801 9.02002 19.0601"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Manage Notifications') }}</span>
                    </a>
                </li>

                <!-- Post Graduation -->
                {{-- <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">{{ __('Post Graduation') }}
                    </h6>
                </li> --}}

                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.post-graduation.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.post-graduation.*', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg fill="#09244B" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path id="XMLID_1705_"
                                        d="M89.6,31.5l-42-18.9c-1.1-0.5-2.3-0.5-3.3,0l-42,18.9C1,32.2,0,33.5,0,35.1c0,1.5,1,2.9,2.4,3.6L6,40.4v14 c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5V43l6,3.2v17c0,0.7,0.2,1.3,0.6,1.9c0.4,0.6,9.5,14.2,27.9,14.2c18.9,0,27.6-13.7,28-14.2 c0.3-0.5,0.6-1.2,0.6-1.8V46.7l15.9-8.1c1.4-0.7,2.2-2.1,2.2-3.6C92,33.5,91,32.2,89.6,31.5z M67,62.1c-2,2.4-8.8,10.2-21.5,10.2 C33.1,72.3,26,64.6,24,62.1V49.7L44.2,60c0.6,0.3,1.2,0.4,1.8,0.4s1.3-0.1,1.9-0.4L67,50.3V62.1z M46,52L13.2,35.4L46,20.6 l32.8,14.8L46,52z M11,60.3c0.7,0.7,1.2,1.8,1.2,2.8c0,1-0.4,2.1-1.2,2.8c-0.7,0.7-1.8,1.2-2.8,1.2s-2.1-0.4-2.8-1.2 c-0.7-0.7-1.2-1.8-1.2-2.8c0-1,0.4-2.1,1.2-2.8c0.7-0.7,1.8-1.2,2.8-1.2S10.2,59.5,11,60.3z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Post Graduation') }}</span>
                    </a>
                </li>

                <!-- Payments -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.payments.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.payments.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M19 20V14M19 14L21 16M19 14L17 16" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H14"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M10 16H6" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M13 16H12.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round">
                                    </path>
                                    <path d="M2 10L22 10" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Payments') }}</span>
                    </a>
                </li>

                <!-- Researches -->
                <li class="sidebar-item mt-0.5 w-full">
                    <div class="cursor-pointer py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:text-blue-500"
                        onclick="toggleAccordion('research')">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.researches.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <!-- أيقونة القسم -->
                            <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#09244B">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title></title>
                                    <g fill="none" fill-rule="evenodd" id="页面-1" stroke="none"
                                        stroke-width="1">
                                        <g id="导航图标" transform="translate(-327.000000, -142.000000)">
                                            <g id="编组" transform="translate(327.000000, 142.000000)">
                                                <rect fill="#FFFFFF" fill-opacity="0.01" fill-rule="nonzero"
                                                    height="24" id="矩形" width="24" x="0" y="0"></rect>
                                                <path
                                                    d="M10.5,19 C15.1944,19 19,15.1944 19,10.5 C19,5.8056 15.1944,2 10.5,2 C5.8056,2 2,5.8056 2,10.5 C2,15.1944 5.8056,19 10.5,19 Z"
                                                    id="路径" stroke="#09244B" stroke-linejoin="round"
                                                    stroke-width="1.5"></path>
                                                <path
                                                    d="M13.3284,7.17155 C12.60455,6.4477 11.60455,6 10.5,6 C9.39545,6 8.39545,6.4477 7.67155,7.17155"
                                                    id="路径" stroke="#09244B" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></path>
                                                <line id="路径" stroke="#09244B" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5" x1="16.6109"
                                                    x2="20.85355" y1="16.6109" y2="20.85355"></line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Researches') }}</span>
                        <svg id="arrow-research" class="ml-auto h-4 w-4 transform transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>

                    <ul id="research" class="hidden max-w-md mx-4  space-y-2 p-4 bg-white rounded-lg">
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('super-admin.researches.index') }}">
                                <span class="flex-1">{{ __('All Researches') }}</span>
                            </a>
                        </li>
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('super-admin.researches.status', ['status' => 'published']) }}">
                                <span class="flex-1">{{ __('Published') }}</span>
                                <span
                                    class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-200 text-blue-800">
                                    {{ $superPublishedResearchesCount }}
                                </span>
                            </a>
                        </li>
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('super-admin.researches.status', ['status' => 'accepted']) }}">
                                <span class="flex-1">{{ __('Accepted') }}</span>
                                <span
                                    class="ml-2 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-200 text-red-800">
                                    {{ $superAcceptedResearchesCount }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.reports.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.reports.*', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="-1 0 24 24"
                                id="meteor-icon-kit__regular-analytics" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 15C2.44772 15 2 15.4477 2 16V21C2 21.5523 2.44772 22 3 22C3.55228 22 4 21.5523 4 21V16C4 15.4477 3.55228 15 3 15zM3 13C4.65685 13 6 14.3431 6 16V21C6 22.6569 4.65685 24 3 24C1.34315 24 0 22.6569 0 21V16C0 14.3431 1.34315 13 3 13zM11 0C12.6569 0 14 1.34315 14 3V21C14 22.6569 12.6569 24 11 24C9.3431 24 8 22.6569 8 21V3C8 1.34315 9.3431 0 11 0zM11 2C10.4477 2 10 2.44772 10 3V21C10 21.5523 10.4477 22 11 22C11.5523 22 12 21.5523 12 21V3C12 2.44772 11.5523 2 11 2zM19 7C20.6569 7 22 8.34315 22 10V21C22 22.6569 20.6569 24 19 24C17.3431 24 16 22.6569 16 21V10C16 8.34315 17.3431 7 19 7zM19 9C18.4477 9 18 9.44771 18 10V21C18 21.5523 18.4477 22 19 22C19.5523 22 20 21.5523 20 21V10C20 9.44771 19.5523 9 19 9z"
                                        fill="#09244B"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Report') }}</span>
                    </a>
                </li>
            @endrole

            <!-- Admin Nav Links -->
            @role('admin')
                <!-- Students -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('admin.students.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('admin.students.*', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg fill="#09244B" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                viewBox="0 0 31.716 31.716" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path
                                            d="M30.604,14.503v-3.815c0.709-0.606,1.112-1.479,1.112-2.416c0-1.322-0.832-2.52-2.069-2.98l-11.44-4.259 c-1.549-0.577-3.275-0.574-4.821,0.007L2.062,5.294C0.829,5.757,0,6.954,0,8.271c0,1.318,0.83,2.514,2.062,2.976l4.236,1.591 l0.005,3.199c-0.091,0.939-0.76,7.993,3.183,12.388c1.601,1.783,3.729,2.688,6.32,2.688c2.593,0,4.718-0.905,6.319-2.688 c4.014-4.474,3.248-11.748,3.18-12.434l0.004-3.126l3.68-1.37v3.008c-0.545,0.395-0.892,1.165-0.892,2.014 c0,1.123,0,2.284,1.697,2.284c1.698,0,1.698-1.162,1.698-2.284C31.494,15.669,31.15,14.898,30.604,14.503z M20.645,27.095 c-1.226,1.364-2.809,2.026-4.838,2.026c-2.031,0-3.611-0.664-4.836-2.026c-2.157-2.397-2.675-5.208-2.754-7.96 c1.834,1.184,4.739,1.792,7.587,1.792c2.853,0,5.761-0.61,7.593-1.802C23.318,21.879,22.804,24.695,20.645,27.095z M8.775,16.187 v-2.418l4.611,1.733c1.545,0.582,3.273,0.583,4.822,0.008l4.628-1.723v2.4c0,0.774-2.737,2.256-7.03,2.256 S8.775,16.961,8.775,16.187z M26.527,9.393l-9.547,3.554c-0.756,0.283-1.603,0.281-2.36-0.003L5.165,9.392 c-0.084-0.031-0.19-0.068-0.307-0.107c-0.542-0.18-1.552-0.518-1.552-1.014c0-0.505,0.963-0.822,1.538-1.011 c0.123-0.04,0.232-0.077,0.321-0.11l9.454-3.552C15,3.454,15.398,3.383,15.804,3.383c0.404,0,0.798,0.071,1.176,0.211l9.549,3.555 c0.078,0.029,0.172,0.062,0.277,0.097c0.52,0.178,1.602,0.544,1.602,1.025C28.408,8.466,28.091,8.815,26.527,9.393z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Students') }}</span>
                    </a>
                </li>

                <!-- Post Graduation -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('admin.post-graduation.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('admin.post-graduation.*', 'icon-active-2') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg fill="#09244B" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path id="XMLID_1705_"
                                        d="M89.6,31.5l-42-18.9c-1.1-0.5-2.3-0.5-3.3,0l-42,18.9C1,32.2,0,33.5,0,35.1c0,1.5,1,2.9,2.4,3.6L6,40.4v14 c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5V43l6,3.2v17c0,0.7,0.2,1.3,0.6,1.9c0.4,0.6,9.5,14.2,27.9,14.2c18.9,0,27.6-13.7,28-14.2 c0.3-0.5,0.6-1.2,0.6-1.8V46.7l15.9-8.1c1.4-0.7,2.2-2.1,2.2-3.6C92,33.5,91,32.2,89.6,31.5z M67,62.1c-2,2.4-8.8,10.2-21.5,10.2 C33.1,72.3,26,64.6,24,62.1V49.7L44.2,60c0.6,0.3,1.2,0.4,1.8,0.4s1.3-0.1,1.9-0.4L67,50.3V62.1z M46,52L13.2,35.4L46,20.6 l32.8,14.8L46,52z M11,60.3c0.7,0.7,1.2,1.8,1.2,2.8c0,1-0.4,2.1-1.2,2.8c-0.7,0.7-1.8,1.2-2.8,1.2s-2.1-0.4-2.8-1.2 c-0.7-0.7-1.2-1.8-1.2-2.8c0-1,0.4-2.1,1.2-2.8c0.7-0.7,1.8-1.2,2.8-1.2S10.2,59.5,11,60.3z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Post Graduation') }}</span>
                    </a>
                </li>

                <!-- Payments -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('admin.payments.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('admin.payments.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M19 20V14M19 14L21 16M19 14L17 16" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H14"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M10 16H6" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M13 16H12.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round">
                                    </path>
                                    <path d="M2 10L22 10" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Payments') }}</span>
                    </a>
                </li>

                <li class="sidebar-item mt-0.5 w-full">
                    <div class="cursor-pointer py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors hover:text-blue-500"
                        onclick="toggleAccordion('research')">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('admin.researches.*') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <!-- أيقونة القسم -->
                            <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#09244B">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title></title>
                                    <g fill="none" fill-rule="evenodd" id="页面-1" stroke="none"
                                        stroke-width="1">
                                        <g id="导航图标" transform="translate(-327.000000, -142.000000)">
                                            <g id="编组" transform="translate(327.000000, 142.000000)">
                                                <rect fill="#FFFFFF" fill-opacity="0.01" fill-rule="nonzero"
                                                    height="24" id="矩形" width="24" x="0" y="0"></rect>
                                                <path
                                                    d="M10.5,19 C15.1944,19 19,15.1944 19,10.5 C19,5.8056 15.1944,2 10.5,2 C5.8056,2 2,5.8056 2,10.5 C2,15.1944 5.8056,19 10.5,19 Z"
                                                    id="路径" stroke="#09244B" stroke-linejoin="round"
                                                    stroke-width="1.5"></path>
                                                <path
                                                    d="M13.3284,7.17155 C12.60455,6.4477 11.60455,6 10.5,6 C9.39545,6 8.39545,6.4477 7.67155,7.17155"
                                                    id="路径" stroke="#09244B" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"></path>
                                                <line id="路径" stroke="#09244B" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5" x1="16.6109"
                                                    x2="20.85355" y1="16.6109" y2="20.85355"></line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Researches') }}</span>
                        <svg id="arrow-research" class="ml-auto h-4 w-4 transform transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>

                    <ul id="research" class="hidden max-w-md mx-4  space-y-2 p-4 bg-white rounded-lg">
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('admin.researches.index') }}">
                                <span class="flex-1">{{ __('All Researches') }}</span>
                            </a>
                        </li>
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('admin.researches.status', ['status' => 'published']) }}">
                                <span class="flex-1">{{ __('Published') }}</span>
                                <span
                                    class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-200 text-blue-800">
                                    {{ $adminPublishedResearchesCount }}
                                </span>
                            </a>
                        </li>
                        <li class="w-full hover:bg-gray-100 rounded-md transition-colors ">
                            <a class="py-2 px-4 flex items-center text-sm font-medium transition-colors"
                                href="{{ route('admin.researches.status', ['status' => 'accepted']) }}">
                                <span class="flex-1">{{ __('Accepted') }}</span>
                                <span
                                    class="ml-2 bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full bg-red-200 text-red-800">
                                    {{ $adminAcceptedResearchesCount }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4  transition-colors"
                        href="{{ route('admin.send-emails.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('admin.send-emails.index', 'icon-active') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="-0.5 0 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M9.00977 21.39H19.0098C20.0706 21.39 21.0881 20.9685 21.8382 20.2184C22.5883 19.4682 23.0098 18.4509 23.0098 17.39V7.39001C23.0098 6.32915 22.5883 5.31167 21.8382 4.56152C21.0881 3.81138 20.0706 3.39001 19.0098 3.39001H7.00977C5.9489 3.39001 4.93148 3.81138 4.18134 4.56152C3.43119 5.31167 3.00977 6.32915 3.00977 7.39001V12.39"
                                        stroke="#09244B" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M1.00977 18.39H11.0098" stroke="#09244B" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1.00977 15.39H5.00977" stroke="#09244B" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M22.209 5.41992C16.599 16.0599 9.39906 16.0499 3.78906 5.41992"
                                        stroke="#09244B" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Send Emails') }}</span>
                    </a>
                </li>
            @endrole


            <!-- Profile -->
            <li class="sidebar-item mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('profile.show') }}">
                    <div
                        class="sidebar-item-icon-box {{ isActiveIcon('profile.show', 'icon-active') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path opacity="0.4"
                                    d="M12.1605 10.87C12.0605 10.86 11.9405 10.86 11.8305 10.87C9.45055 10.79 7.56055 8.84 7.56055 6.44C7.56055 3.99 9.54055 2 12.0005 2C14.4505 2 16.4405 3.99 16.4405 6.44C16.4305 8.84 14.5405 10.79 12.1605 10.87Z"
                                    stroke="#09244B" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M7.1607 14.56C4.7407 16.18 4.7407 18.82 7.1607 20.43C9.9107 22.27 14.4207 22.27 17.1707 20.43C19.5907 18.81 19.5907 16.17 17.1707 14.56C14.4307 12.73 9.9207 12.73 7.1607 14.56Z"
                                    stroke="#09244B" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Profile') }}</span>
                </a>
            </li>

            @role('super-admin')
                <!-- Setting -->
                <li class="sidebar-item mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('super-admin.settings.index') }}">
                        <div
                            class="sidebar-item-icon-box {{ isActiveIcon('super-admin.settings.index', 'icon-active') }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M3 9.10986V14.8799C3 16.9999 3 16.9999 5 18.3499L10.5 21.5299C11.33 22.0099 12.68 22.0099 13.5 21.5299L19 18.3499C21 16.9999 21 16.9999 21 14.8899V9.10986C21 6.99986 21 6.99986 19 5.64986L13.5 2.46986C12.68 1.98986 11.33 1.98986 10.5 2.46986L5 5.64986C3 6.99986 3 6.99986 3 9.10986Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path opacity="0.34"
                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ __('Settings') }}</span>
                    </a>
                </li>
            @endrole
        </ul>
    </div>

    <script>
        function toggleAccordion(id) {
            const element = document.getElementById(id);
            const arrow = document.querySelector(`#arrow-${id}`);

            if (element) {
                element.classList.toggle('hidden');
                if (arrow) {
                    arrow.classList.toggle('rotate-180');
                }
            }
        }
    </script>
</aside>

<!-- الشاشة السوداء الشفافة -->
<div id="overlay" class="fixed inset-0 z-980 hidden"></div>
<!-- end sidenav -->
