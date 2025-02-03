<x-app-layout>
    <div class="px-3 md:px-10 pb-20 overflow-y-auto h-screen">
        <h1 class="text-2xl font-medium  capitalize py-10">hello, this is the dashboard</h1>

        <div class="">
            <div class="grid gap-14 sm:grid-cols-2 md:grid-cols-4 md:gap-5">
                <div class="rounded-xl bg-white p-6 text-center shadow-xl" id="facebook">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full bg-blue-600 shadow-lg shadow-blue-500/40">
                        <i class='bx bxl-facebook-circle text-2xl text-white'></i>
                    </div>
                    <h1 class="text-darken mb-3 text-xl font-medium lg:px-14">Facebook</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
                <div class="rounded-xl bg-white p-6 text-center shadow-xl" id="instagram">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full bg-purple-400 shadow-lg shadow-purple-500/40">
                        <i class='bx bxl-instagram-alt text-2xl text-white' ></i>
                    </div>
                    <h1 class="text-darken mb-3 text-xl font-medium lg:px-14">Instagram</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
                <div data-aos-delay="150" class="rounded-xl bg-white p-6 text-center shadow-xl" id="youtube">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full shadow-lg bg-rose-500 shadow-rose-500/40"">
                        <i class='bx bxl-youtube text-2xl text-white' ></i>
                    </div>
                    <h1 class="text-darken mb-3 text-xl font-medium lg:px-14 ">Youtube</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
                <div data-aos-delay="300" class="rounded-xl bg-white p-6 text-center shadow-xl" id="tiktok">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full shadow-lg bg-gray-700 shadow-gray-500/40">
                        <i class='bx bxl-tiktok text-2xl text-white' ></i>
                    </div>
                    <h1 class="text-darken mb-3 pt-3 text-xl font-medium lg:h-14 lg:px-14">Tiktok</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
            </div>

        </div>


        <!-- component -->

        {{-- <div class="mx-auto flex w-full  flex-col justify-center mt-10">
            <div
                class="border bg-card text-card-foreground shadow-sm w-full items-center justify-between rounded-lg bg-clip-border border-zinc-800">
                <div
                    class="flex-col p-6 flex items-start md:items-center justify-between gap-4 space-y-0 py-5 sm:flex-row">
                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-full border text-4xl border-zinc-800 ">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                            aria-hidden="true" class="h-5 w-5" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z">
                            </path>
                        </svg>
                    </div>
                    <div class="grid flex-1 gap-1 text-left">
                        <h3 class="tracking-tight text-2xl font-bold leading-6 ">
                            149,758
                        </h3>
                        <p class="text-xs font-medium leading-5 text-zinc-400">
                            Credits usage in the last year
                        </p>
                    </div>
                    <button type="button"
                        class="flex h-10 items-center justify-between border !border-zinc-800 bg-zinc-950  px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&amp;>span]:line-clamp-1 w-[160px] rounded-lg sm:ml-auto"
                        aria-label="Select a value">
                        <span style="pointer-events: none">Last 30 days</span><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down h-4 w-4 opacity-50" aria-hidden="true">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                </div>

                

            </div>
        </div> --}}

        
        <div class=" mt-10">
            <div class="max-w-md w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">3.4k
                            </h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated per
                                week</p>
                        </div>
                    </div>
                    <div>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            42.5%
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Money spent:</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:
                        </dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
                    </dl>
                </div>

                <div id="column-chart"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <!-- Button -->
                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                            data-dropdown-placement="bottom"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                            type="button">
                            Last 7 days
                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                        7 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                        30 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                        90 days</a>
                                </li>
                            </ul>
                        </div>
                        <a href="#"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Leads Report
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const options = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [{
                    name: "Organic",
                    color: "#1A56DB",
                    data: [{
                            x: "Mon",
                            y: 231
                        },
                        {
                            x: "Tue",
                            y: 122
                        },
                        {
                            x: "Wed",
                            y: 63
                        },
                        {
                            x: "Thu",
                            y: 421
                        },
                        {
                            x: "Fri",
                            y: 122
                        },
                        {
                            x: "Sat",
                            y: 323
                        },
                        {
                            x: "Sun",
                            y: 111
                        },
                    ],
                },
                {
                    name: "Social media",
                    color: "#FDBA8C",
                    data: [{
                            x: "Mon",
                            y: 232
                        },
                        {
                            x: "Tue",
                            y: 113
                        },
                        {
                            x: "Wed",
                            y: 341
                        },
                        {
                            x: "Thu",
                            y: 224
                        },
                        {
                            x: "Fri",
                            y: 522
                        },
                        {
                            x: "Sat",
                            y: 411
                        },
                        {
                            x: "Sun",
                            y: 243
                        },
                    ],
                },
            ],
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            states: {
                hover: {
                    filter: {
                        type: "darken",
                        value: 1,
                    },
                },
            },
            stroke: {
                show: true,
                width: 0,
                colors: ["transparent"],
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -14
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                floating: false,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
            fill: {
                opacity: 1,
            },
        }

        if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("column-chart"), options);
            chart.render();
        }
    </script>

</x-app-layout>
