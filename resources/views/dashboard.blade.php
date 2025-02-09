<x-app-layout>
    @vite(['resources/js/drivers.js'])
    <div class="px-3 md:px-10 pb-20 overflow-y-auto h-screen ">
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
                        <i class='bx bxl-instagram-alt text-2xl text-white'></i>
                    </div>
                    <h1 class="text-darken mb-3 text-xl font-medium lg:px-14">Instagram</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
                <div data-aos-delay="150" class="rounded-xl bg-white p-6 text-center shadow-xl" id="youtube">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full shadow-lg bg-rose-500 shadow-rose-500/40"">
                        <i class='bx bxl-youtube text-2xl text-white'></i>
                    </div>
                    <h1 class="text-darken mb-3 text-xl font-medium lg:px-14 ">Youtube</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
                <div data-aos-delay="300" class="rounded-xl bg-white p-6 text-center shadow-xl" id="tiktok">
                    <div
                        class="mx-auto flex h-16 w-16 -translate-y-12 transform items-center justify-center rounded-full shadow-lg bg-gray-700 shadow-gray-500/40">
                        <i class='bx bxl-tiktok text-2xl text-white'></i>
                    </div>
                    <h1 class="text-darken mb-3 pt-3 text-xl font-medium lg:h-14 lg:px-14">Tiktok</h1>
                    <p class="px-4 text-gray-500"></p>
                </div>
            </div>

        </div>


        <!-- component -->




        <div class=" mt-10" id="response_chart">
            <div>
                <h3 class="font-medium text-xl mt-10 mb-2">Response Chart</h3>
            </div>
            <div class="max-w-screen-lg w-full bg-white rounded-lg shadow-sm  p-4 md:p-6">
                {{-- <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 ">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-gray-100  flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="leading-none text-2xl font-bold text-gray-900  pb-1">3.4k
                            </h5>
                            <p class="text-sm font-normal text-gray-500 ">Leads generated per
                                week</p>
                        </div>
                    </div>
                    <div>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md ">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            42.5%
                        </span>
                    </div>
                </div> --}}

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500  text-sm font-normal me-1">Total Acceptance:</dt>
                        <dd class="text-gray-900 text-sm font-semibold">{{ \Illuminate\Support\Facades\DB::table('campaign_influencer')->where('task_status', 'accepted')->count() }}</dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500  text-sm font-normal me-1">Total Decline:
                        </dt>
                        <dd class="text-gray-900 text-sm  font-semibold">{{ \Illuminate\Support\Facades\DB::table('campaign_influencer')->where('task_status', 'declined')->count() }}</dd>
                    </dl>
                </div>

                <div id="column-chart"></div>
            
            </div>

        </div>
    </div>


    @php
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        // Fetch accepted data
        $acceptRawData = \Illuminate\Support\Facades\DB::table('campaign_influencer')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('task_status', 'accepted')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Format accepted data
        $acceptData = [];
        foreach ($months as $num => $name) {
            $acceptData[] = [
                'x' => $name,
                'y' => $acceptRawData[$num] ?? 0, // Default to 0 if no data
            ];
        }

        // Fetch declined data
        $declinedRawData = \Illuminate\Support\Facades\DB::table('campaign_influencer')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('task_status', 'declined')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Format declined data
        $declinedData = [];
        foreach ($months as $num => $name) {
            $declinedData[] = [
                'x' => $name,
                'y' => $declinedRawData[$num] ?? 0, // Default to 0 if no data
            ];
        }
    @endphp


    <script>
        const options = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [{
                    name: "Declined",
                    color: "#1A56DB",

                    data:  @json($declinedData),
                   
                },
                {
                    name: "Accepted",
                    color: "#FDBA8C",
                    data: @json($acceptData),
                   
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
