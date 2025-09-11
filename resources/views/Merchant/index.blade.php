@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200">
        <div class="p-4 border-2 rounded-lg mt-14">
            <!-- Stats Cards Row - Improved Responsiveness -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <!-- Total Revenue Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500">Total Revenue</p>
                            <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800 mt-1">
                                MMK
                                {{ $TotalMMK }}</p>
                            @if ($TotalUSD)
                                <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800">
                                    USD {{ $TotalUSD }}</p>
                            @endif

                        </div>

                        <div class="p-2 sm:p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                    </div>
                </div>

                <!-- Total Transactions Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500">Transactions</p>
                            <p
                                class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800 mt-1">
                                {{ $TotalTnx }}</p>

                        </div>
                        <div class="p-2 sm:p-3 rounded-full bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Success Rate Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs mt-1 font-medium text-gray-500">Success Rate</p>
                            <p
                                class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                {{ number_format($SuccessRate, 2) }}%
                                <span
                                    class="inline-flex items-center px-2 py-0.5 text-[10px] rounded-full bg-red-100 text-red-700 font-medium mt-1">
                                    {{ $Totallink }} Links Created
                                </span>
                            </p>
                        </div>
                        <div class="p-2 sm:p-3 rounded-full bg-purple-50 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-4">

                    <!-- Pills -->
                    <div class="flex flex-wrap gap-2 mx-3">
                        <span class="px-3 py-1 text-[11px] font-medium text-green-700 bg-green-100 rounded-full">
                            {{ $TotalSuccess }} Success
                        </span>
                        <span class="px-3 py-1 text-[11px] font-medium text-red-700 bg-red-100 rounded-full">
                            {{ $TotalFailed }} Failed
                        </span>
                        <span class="px-3 py-1 text-[11px] font-medium text-yellow-700 bg-yellow-100 rounded-full">
                            {{ $TotalPending }} Pending
                        </span>
                    </div>

                    <!-- Filters -->
                    <form method="GET" action="{{ route('merchant.dashboard') }}" id="filterForm"
                        class="flex flex-wrap items-center gap-4">

                        {{-- Year Filter --}}
                        <label class="flex items-center gap-2">
                            <span class="text-sm text-gray-700">Years</span>
                            <select name="year" id="yearSelect"
                                class="py-1 text-center text-sm focus:ring-blue-300 border-0 border-b border-blue-900">
                                <option value="all" {{ request('year') === 'all' ? 'selected' : '' }}>All</option>
                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </label>

                        {{-- Month Filter --}}
                        <label class="flex items-center gap-2">
                            <span class="text-sm text-gray-700">Month</span>
                            <select name="month" id="monthSelect"
                                class="py-1 text-center text-sm focus:ring-blue-300 border-0 border-b border-blue-900">
                                <option value="all" {{ request('month') === 'all' ? 'selected' : '' }}>
                                    {{ request('year') === 'all' ? 'Select A Year' : 'All' }}
                                </option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </form>
                </div>

                <div id="revenueChart" class="w-full mt-2" style="min-height: 300px;"></div>
            </div>
            <!-- Bottom Row - Improved Responsiveness -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <!-- Transaction Types Table - Improved Responsiveness -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100 overflow-x-auto">
                    <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-800 mb-4">
                        Most Used Payment Type
                    </h3>


                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider text-center">
                                        No</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Logo</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Payment Name</th>
                                    <th scope="col"
                                        class="px-3 py-2 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Count</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($Mostuse as $item)
                                    <tr>
                                        <td
                                            class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] text-center font-medium text-gray-900">
                                            {{ $loop->iteration }}</td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-2 flex justify-center whitespace-nowrap">
                                            <img src="{{ $item->payment_logo }}" alt="{{ $item->paymentCode }}"
                                                class="w-8  rounded-md">
                                        </td>
                                        <td
                                            class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] text-center text-gray-500">
                                            {{ $item->paymentCode }}</td>
                                        <td
                                            class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] text-center text-gray-500">
                                            {{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Transactions Table - Improved Responsiveness -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 overflow-x-auto">
                    <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-800 mb-4">Recent Transactions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-1 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider">
                                        Invoice No</th>
                                    <th scope="col"
                                        class="px-3 py-1 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-3 py-1 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-3 py-1 sm:px-6 sm:py-3 text-left text-[11px] font-medium text-gray-500 uppercase tracking-wider">
                                        Created By</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($Latest as $item)
                                    <tr>
                                        <td
                                            class="px-3 py-1 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] font-medium text-gray-900 truncate max-w-[120px] sm:max-w-none">
                                            {{ $item->tranref_no }}</td>
                                        <td class="px-3 py-1 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] text-gray-500">
                                            {{ $item->req_amount }}</td>
                                        <td class="px-3 py-1 sm:px-6 sm:py-4 whitespace-nowrap">
                                            @if ($item->payment_status == 'SUCCESS')
                                                <span
                                                    class="px-2 inline-flex text-[10px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">Success</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-1 sm:px-6 sm:py-4 whitespace-nowrap text-[11px] text-gray-500">
                                            {{ $item->created_by }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                series: [{
                    name: 'Revenue',
                    data: @json($revenueData['data'])

                }],
                markers: {
                    size: 0,
                    hover: {
                        size: 0,
                    },
                },
                chart: {
                    type: 'area',
                    height: '100%',
                    width: '100%',
                    toolbar: {
                        show: true,
                        tools: {
                            download: '<i class="fa-solid fa-download"></i>',
                            reset: true,
                        },
                    },
                    zoom: {
                        enabled: false
                    },
                    animations: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: false
                    }
                },
                colors: ['#4f6dab'],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    categories: @json($revenueData['labels']),
                    labels: {
                        style: {
                            fontSize: '10px',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: (value) => "MMK " + value.toLocaleString(),
                        style: {
                            fontSize: '10px',
                        }
                    }
                },
                tooltip: {
                    enabled: false,
                    y: {
                        formatter: (value) => "MMK " + value.toLocaleString(),
                        style: {
                            fontSize: '10px',
                        }
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#f0f0f0',
                    strokeDashArray: 0
                }
            };

            try {
                const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
                chart.render();
            } catch (error) {
                console.error("Error rendering chart:", error);
            }
        });
    </script>
    <script>
        const yearSelect = document.getElementById('yearSelect');
        const monthSelect = document.getElementById('monthSelect');
        const form = document.getElementById('filterForm');

        function toggleOptions() {
            monthSelect.disabled = yearSelect.value === 'all';
            yearSelect.querySelector('option[value="all"]').disabled = monthSelect.value !== 'all';
        }
        yearSelect.addEventListener('change', () => {
            toggleOptions();
            form.submit();
        });
        monthSelect.addEventListener('change', () => {
            toggleOptions();
            form.submit();
        });
        toggleOptions();
    </script>
@endsection
