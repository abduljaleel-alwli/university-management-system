<div>
    <!-- الإحصائيات -->
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">

            @role('super-admin')
                <!-- عدد الـ Super Admins -->
                <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                            {{ __('Number of Super Admins') }}
                                        </p>
                                        <h5 class="mb-0 font-bold text-gray-700">{{ $totalSuperAdmins ?? 0 }}</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-center basis-1/3">
                                    <div
                                        class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-gray-500 to-gray-800">
                                        <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="margin: auto">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <circle cx="10" cy="6" r="4" stroke="#ffffff"
                                                    stroke-width="1.5"></circle>
                                                <path opacity="0.5"
                                                    d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z"
                                                    stroke="#ffffff" stroke-width="1.5"></path>
                                                <path d="M19 2C19 2 21 3.2 21 6C21 8.8 19 10 19 10" stroke="#ffffff"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                                <path d="M17 4C17 4 18 4.6 18 6C18 7.4 17 8 17 8" stroke="#ffffff"
                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- عدد الـ Admins -->
                <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                            {{ __('Number of Admins') }}
                                        </p>
                                        <h5 class="mb-0 font-bold text-gray-700">{{ $totalAdmins ?? 0 }}</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-center basis-1/3">
                                    <div
                                        class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-gray-500 to-gray-800">
                                        <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="margin: auto">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <circle cx="12" cy="6" r="4" stroke="#ffffff"
                                                    stroke-width="1.5"></circle>
                                                <path
                                                    d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18"
                                                    stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole


            <!-- إجمالي المدفوعات بالدينار -->
            <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Total Payments (IQD)') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-gray-700">
                                        {{ number_format($totalPaymentsIQD, 2) ?? 0 }} {{ __('IQD') }}
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-green-800">
                                    <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M19 20V14M19 14L21 16M19 14L17 16" stroke="#ffffff"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path
                                                d="M22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H14"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path d="M10 16H6" stroke="#ffffff" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                            <path d="M13 16H12.5" stroke="#ffffff" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                            <path d="M2 10L22 10" stroke="#ffffff" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إجمالي المدفوعات بالدولار -->
            <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Total Payments (USD)') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-gray-700">
                                        {{ number_format($totalPaymentsUSD, 2) ?? 0 }} {{ __('USD') }}
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-green-800">
                                    <svg width="15px" height="15px" viewBox="0 0 48.00 48.00" id="b"
                                        xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"
                                        stroke-width="2.5" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <defs>
                                                <style>
                                                    .c {
                                                        fill: none;
                                                        stroke: #ffffff;
                                                        stroke-linecap: round;
                                                        stroke-linejoin: round;
                                                    }
                                                </style>
                                            </defs>
                                            <path class="c"
                                                d="m10.7031,13.4555h28.3281c1.7344,0,3.4688,1.7344,3.4688,3.4688v20.2344c0,1.7344-1.7344,3.4688-3.4688,3.4688H8.9688c-1.7344,0-3.4688-1.7344-3.4688-3.4688V13.4555c0-2.8906.5781-3.7578,2.8906-3.7578l24.8594-2.3125c2.0234-.1156,2.3125.5781,2.3125,1.4453v4.625">
                                            </path>
                                            <path class="c"
                                                d="m18.8304,34.0345c1.3342,1.0006,2.6683,1.3341,5.3366,1.3341h1.3342c2.3947,0,4.3359-1.9413,4.3359-4.3359s-1.9413-4.3359-4.3359-4.3359h-3.0019c-2.3947,0-4.3359-1.9413-4.3359-4.3359s1.9413-4.3359,4.3359-4.3359h1.3342c3.0017,0,4.3359.3336,5.3366,1.3342">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إجمالي الطلاب -->
            <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Total Students') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-gray-700">
                                        {{ $totalStudents ?? 0 }}
                                        {{-- <span class="leading-normal text-sm font-weight-bolder text-lime-500">
                                            +{{ $latestStudents->count() }}
                                        </span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-500 to-blue-800">
                                    <svg fill="#ffffff" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="15px" height="15px" viewBox="0 0 31.72 31.72" xml:space="preserve"
                                        stroke="#ffffff" stroke-width="0.00031716000000000003" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <path
                                                    d="M30.604,14.503v-3.815c0.709-0.606,1.112-1.479,1.112-2.416c0-1.322-0.832-2.52-2.069-2.98l-11.44-4.259 c-1.549-0.577-3.275-0.574-4.821,0.007L2.062,5.294C0.829,5.757,0,6.954,0,8.271c0,1.318,0.83,2.514,2.062,2.976l4.236,1.591 l0.005,3.199c-0.091,0.939-0.76,7.993,3.183,12.388c1.601,1.783,3.729,2.688,6.32,2.688c2.593,0,4.718-0.905,6.319-2.688 c4.014-4.474,3.248-11.748,3.18-12.434l0.004-3.126l3.68-1.37v3.008c-0.545,0.395-0.892,1.165-0.892,2.014 c0,1.123,0,2.284,1.697,2.284c1.698,0,1.698-1.162,1.698-2.284C31.494,15.669,31.15,14.898,30.604,14.503z M20.645,27.095 c-1.226,1.364-2.809,2.026-4.838,2.026c-2.031,0-3.611-0.664-4.836-2.026c-2.157-2.397-2.675-5.208-2.754-7.96 c1.834,1.184,4.739,1.792,7.587,1.792c2.853,0,5.761-0.61,7.593-1.802C23.318,21.879,22.804,24.695,20.645,27.095z M8.775,16.187 v-2.418l4.611,1.733c1.545,0.582,3.273,0.583,4.822,0.008l4.628-1.723v2.4c0,0.774-2.737,2.256-7.03,2.256 S8.775,16.961,8.775,16.187z M26.527,9.393l-9.547,3.554c-0.756,0.283-1.603,0.281-2.36-0.003L5.165,9.392 c-0.084-0.031-0.19-0.068-0.307-0.107c-0.542-0.18-1.552-0.518-1.552-1.014c0-0.505,0.963-0.822,1.538-1.011 c0.123-0.04,0.232-0.077,0.321-0.11l9.454-3.552C15,3.454,15.398,3.383,15.804,3.383c0.404,0,0.798,0.071,1.176,0.211l9.549,3.555 c0.078,0.029,0.172,0.062,0.277,0.097c0.52,0.178,1.602,0.544,1.602,1.025C28.408,8.466,28.091,8.815,26.527,9.393z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- الأبحاث المنشورة -->
            <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Researches') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-gray-700">
                                        {{ ($researchCounts['published'] ?? 0) + ($researchCounts['accepted'] ?? 0) }}

                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-red-500 to-red-800">
                                    <svg width="15px" height="15px" viewBox="0 0 24 24" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        fill="#ffffff" stroke="#ffffff" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title></title>
                                            <g fill="none" fill-rule="evenodd" id="页面-1" stroke="none"
                                                stroke-width="1">
                                                <g id="导航图标" transform="translate(-327.000000, -142.000000)">
                                                    <g id="编组" transform="translate(327.000000, 142.000000)">
                                                        <rect fill="#FFFFFF" fill-opacity="0.01" fill-rule="nonzero"
                                                            height="24" id="矩形" width="24" x="0" y="0">
                                                        </rect>
                                                        <path
                                                            d="M10.5,19 C15.1944,19 19,15.1944 19,10.5 C19,5.8056 15.1944,2 10.5,2 C5.8056,2 2,5.8056 2,10.5 C2,15.1944 5.8056,19 10.5,19 Z"
                                                            id="路径" stroke="#ffffff" stroke-linejoin="round"
                                                            stroke-width="1.5"></path>
                                                        <path
                                                            d="M13.3284,7.17155 C12.60455,6.4477 11.60455,6 10.5,6 C9.39545,6 8.39545,6.4477 7.67155,7.17155"
                                                            id="路径" stroke="#ffffff" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5"></path>
                                                        <line id="路径" stroke="#ffffff" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5" x1="16.6109"
                                                            x2="20.85355" y1="16.6109" y2="20.85355"></line>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- عدد الطلاب المتخرجين -->
            <div class="px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Graduated Students') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-green-600">{{ $totalGraduatedStudents ?? 0 }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-teal-500 to-teal-800">
                                    <svg fill="#ffffff" width="15px" height="15px" viewBox="0 0 256 256"
                                        id="Flat" xmlns="http://www.w3.org/2000/svg" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M224,64,128,96,32,64l96-32Z" opacity="0.2"></path>
                                            <path
                                                d="M226.52979,56.41016l-96-32a8.00672,8.00672,0,0,0-5.05958,0L29.6239,56.35889l-.00976.00341-.14393.04786c-.02819.00927-.053.02465-.08105.03442a7.91407,7.91407,0,0,0-1.01074.42871c-.03748.019-.07642.03516-.11353.05469a7.97333,7.97333,0,0,0-.93139.58325c-.06543.04688-.129.09522-.19288.144a8.09113,8.09113,0,0,0-.81872.71119c-.02374.02416-.04443.05053-.06787.0747a8.03121,8.03121,0,0,0-.66107.783c-.04157.05567-.0846.10986-.12476.16675a8.00867,8.00867,0,0,0-.56714.92993c-.02582.04981-.04809.10083-.07287.15112a7.93932,7.93932,0,0,0-.40522.97608c-.01062.03149-.0238.06128-.034.093a7.95072,7.95072,0,0,0-.26288,1.08544c-.01337.07666-.024.15308-.0351.23A8.02889,8.02889,0,0,0,24,64v80a8,8,0,0,0,16,0V75.09985L73.58514,86.29492a63.97188,63.97188,0,0,0,20.42945,87.89746,95.88127,95.88127,0,0,0-46.48383,37.4375,7.9997,7.9997,0,1,0,13.40235,8.73828,80.023,80.023,0,0,1,134.1333,0,7.99969,7.99969,0,1,0,13.40234-8.73828,95.87928,95.87928,0,0,0-46.48346-37.43725,63.97209,63.97209,0,0,0,20.42957-87.89771l44.11493-14.70508a8.0005,8.0005,0,0,0,0-15.17968ZM176,120A48,48,0,1,1,89.34875,91.54932l36.12146,12.04052a8.00672,8.00672,0,0,0,5.05958,0l36.12146-12.04052A47.85424,47.85424,0,0,1,176,120Zm-9.29791-45.3335c-.01984.00708-.03992.01294-.05976.02L128,87.56738,89.35785,74.68652c-.02033-.00732-.04083-.01318-.06122-.0205L57.29834,64,128,40.43262,198.70166,64Z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- عدد الطلاب الراسبين -->
            <div class="px-3 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0font-semibold leading-normal text-sm" style="min-width: 140px">
                                        {{ __('Failed Students') }}
                                    </p>
                                    <h5 class="mb-0 font-bold text-red-600">{{ $totalFailedStudents ?? 0 }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-center basis-1/3">
                                <div
                                    class="flex icon-active inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-orange-500 to-orange-800">
                                    <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="margin: auto">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <circle cx="10" cy="6" r="4" stroke="#ffffff"
                                                stroke-width="1.5"></circle>
                                            <path d="M21 10H19H17" stroke="#ffffff" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-6">

        <!-- قائمة الإشعارات -->
        <div class="mt-2 bg-white shadow-soft-xl rounded-2xl z-50 overflow-hidden">
            <div class="p-4">
                <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('Latest Notifications') }}</h3>

                @if ($latestNotifications->isEmpty())
                    <p class="text-gray-600 text-sm text-center py-4">{{ __('No notifications.') }}</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($latestNotifications as $notification)
                            {{-- Model --}}
                            @php
                                $student = \App\Models\Student::find($notification->data['student_id']);
                            @endphp

                            <li class="py-4 border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                                <div class="flex justify-between items-start px-4">
                                    <div class="space-y-2">
                                        @if (isset($notification->data['type']) && $notification->data['type'] === 'student-end-date')
                                            <a href="#"
                                                class="text-sm text-gray-800 hover:text-gray-900 font-medium">
                                                {{ __('The student study period ends') }}
                                                <strong
                                                    class="text-blue-600">{{ $student ? $student->full_name : __('Unknown') }}</strong>
                                                {{ __('after 3 months.') }}
                                            </a>
                                            <div>
                                                @role('super-admin')
                                                    @isset($notification->data['super-url'])
                                                        <a href="{{ $notification->data['super-url'] }}"
                                                            class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition">
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
                                            </div>
                                        @elseif(isset($notification->data['type']) && $notification->data['type'] === 'post-graduation')
                                            <a href="#"
                                                class="text-sm text-gray-800 hover:text-gray-900 font-medium">
                                                {{ __('A graduation discussion has been created for the student') }}
                                                <strong
                                                    class="text-blue-600">{{ $student ? $student->full_name : 'غير معروف' }}</strong>
                                                {{ __('Please complete the procedure.') }}
                                            </a>
                                            <div class="mt-2 space-x-2">
                                                @role('super-admin')
                                                    @isset($notification->data['students-super-url'])
                                                        <a href="{{ $notification->data['students-super-url'] }}"
                                                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition"
                                                            style="margin: 0 px">
                                                            {{ __('View Student') }}
                                                        </a>
                                                    @endisset
                                                    @isset($notification->data['graduation-super-url'])
                                                        <a href="{{ $notification->data['graduation-super-url'] }}"
                                                            class="bg-blue-600 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-700 transition"
                                                            style="margin: 0 px">
                                                            {{ __('View Graduation') }}
                                                        </a>
                                                    @endisset
                                                @else
                                                    @isset($notification->data['students-url'])
                                                        <a href="{{ $notification->data['students-url'] }}"
                                                            class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                                            style="margin: 0 px">
                                                            {{ __('View Student') }}
                                                        </a>
                                                    @endisset
                                                    @isset($notification->data['graduation-url'])
                                                        <a href="{{ $notification->data['graduation-url'] }}"
                                                            class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition"
                                                            style="margin: 0 px">
                                                            {{ __('View Discussion') }}
                                                        </a>
                                                    @endisset
                                                @endrole
                                            </div>
                                        @else
                                            @role('admin')
                                                <div
                                                    class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-md inline-block">
                                                    {{ __('From Super Admin') }}
                                                </div>
                                                <a href="#"
                                                    class="block text-sm text-gray-800 hover:text-gray-900 font-medium mt-2">
                                                    {{ $notification->data['message'] }}
                                                </a>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ __('Student') }}:
                                                    <strong>{{ $student ? $student->first_name . ' ' . $student->last_name : __('Unknown') }}</strong>
                                                </p>
                                                <a href="/panel/students/{{ $student->id }}"
                                                    class="mt-2 inline-block bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                                    {{ __('View Student') }}
                                                </a>
                                            @endrole
                                        @endif
                                    </div>

                                    @if (is_null($notification->read_at))
                                        <a href="#markAsRead"
                                            class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-lg hover:bg-green-200 transition">
                                            {{ __('Unread') }}
                                        </a>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 mt-2 px-4">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            {{-- --------------------  Tables -------------------- --}}
            @role('super-admin')
                <!-- قائمة المستخدمين المضافين -->
                <div class="bg-white p-6 shadow-soft-xl rounded-2xl">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Latest Added Users') }}</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Name') }}</th>
                                <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Email') }}</th>
                                <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Role') }}</th>
                                <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($latestUsers) && is_array($latestUsers))
                                @foreach ($latestUsers as $user)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="p-3 border-t text-sm text-gray-700">{{ $user->name }}</td>
                                        <td class="p-3 border-t text-sm text-gray-700">{{ $user->email }}</td>
                                        <td class="p-3 border-t text-sm text-gray-700">
                                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                                        </td>
                                        <td class="p-3 border-t text-sm text-gray-700">
                                            {{ $user->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" class="p-3 border-t text-sm text-gray-700 text-center">
                                        {{ __('No data available') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @endrole

            <!-- عدد الطلاب في كل قسم -->
            <div class="bg-white p-6 shadow-soft-xl rounded-2xl">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Number of Students in Each Department') }}
                </h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Department') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">
                                {{ __('Number of Students') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($studentsPerDepartment) && is_array($studentsPerDepartment))
                            @foreach ($studentsPerDepartment as $dept)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $dept->name }}</td>
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $dept->student->count() }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="p-3 border-t text-sm text-gray-700 text-center">
                                    {{ __('No data available') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>


            <!-- حالة الطلاب -->
            <div class="bg-white p-6 shadow-soft-xl rounded-2xl">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Student Status') }}</h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Status') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">
                                {{ __('Number of Students') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($latestStudents) && is_array($latestStudents))
                            @foreach ($studentsByStatus as $status => $count)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-3 border-t text-sm text-gray-700">
                                        @if ($status == 'suspended')
                                            {{ __('Suspended') }}
                                        @elseif($status == 'pending_review')
                                            {{ __('Pending Review') }}
                                        @else
                                            {{ __('Active') }}
                                        @endif
                                    </td>
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $count }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="p-3 border-t text-sm text-gray-700 text-center">
                                    {{ __('No data available') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- قائمة آخر الطلاب المضافين -->
            <div class="bg-white p-6 shadow-soft-xl rounded-2xl">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Latest Added Students') }}</h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Name') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Department') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Added Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($latestStudents) && is_array($latestStudents))
                            @foreach ($latestStudents as $student)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $student->first_name }}
                                        {{ $student->last_name }}</td>
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $student->department->name }}
                                    </td>
                                    <td class="p-3 border-t text-sm text-gray-700">
                                        {{ $student->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="p-3 border-t text-sm text-gray-700 text-center">
                                    {{ __('No data available') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- أحدث الأبحاث المسجلة -->
            <div class="bg-white p-6 shadow-soft-xl rounded-2xl">
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Latest Registered Researches') }}</h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Title') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Department') }}</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">{{ __('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($latestResearches) && is_array($latestResearches))
                            @foreach ($latestResearches as $research)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $research->title }}</td>
                                    <td class="p-3 border-t text-sm text-gray-700">{{ $research->department->name }}
                                    </td>
                                    <td class="p-3 border-t text-sm text-gray-700">
                                        {{ $research->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="p-3 border-t text-sm text-gray-700 text-center">
                                    {{ __('No data available') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
