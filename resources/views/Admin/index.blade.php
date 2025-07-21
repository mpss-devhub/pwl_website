@extends('Admin.layouts.dashboard')
@section('admin_content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div class="p-4 sm:ml-64 bg-gray-50">
        <div class="p-4 rounded-lg mt-14">
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard Overview</h2>

            </div>

            <!-- Stats Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ number_format($totalUsers) }}</p>
                            <!--<p class="text-xs text-green-500 mt-1">+ 5.2% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Merchants -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Merchants</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ number_format($activeMerchants) }}</p>
                            <!-- <p class="text-xs text-green-500 mt-1">+ 3.1% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Transaction Amount</p>
                            <div class="flex ">
                                <p class="text-2xl font-semibold text-gray-800">{{ number_format($totalTransactionAmount) }}
                                </p><small class="text-muted text-gray-500 mt-2 mx-1">MMK</small>
                            </div>
                            <!--<p class="text-xs text-red-500 mt-1">- 1.4% from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Transaction</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ number_format($totalTransactions) }}</p>
                            <!--<p class="text-xs text-red-500 mt-1">- 2 from yesterday</p>-->
                        </div>
                        <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Revenue Analytics</h3>
                    </div>
                    <div class="h-80">


                        <!-- Chart container - Replace with your actual chart implementation -->
                        <div class="flex items-center justify-center h-full bg-gray-50 rounded-md">
                            <div id="revenueChart" class="w-full" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- User Growth Chart -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">User Growth</h3>
                          <div class="">
                            <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
                                <label for="filter" class="text-sm text-gray-600">View by:</label>
                                <select name="filter" id="filter" onchange="this.form.submit()"
                                    class="ml-2 py-1  rounded border-gray-300">
                                    <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Daily
                                    </option>
                                    <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Weekly
                                    </option>
                                    <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Monthly
                                    </option>
                                    <option value="yearly" {{ request('filter') == 'yearly' ? 'selected' : '' }}>Yearly
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="h-80">
                        <!-- Chart container - Replace with your actual chart implementation -->
                        <div class="flex items-center justify-center h-full bg-gray-50 rounded-md">
                            <div id="userGrowthChart" class="w-full" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities (Spanning 2 columns) -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100 lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        @forelse($latestTransactions as $tx)
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800">
                                            {{ $tx->link->link_name ?? 'Unknown User' }}
                                        </span>
                                        made a
                                        <span class="font-medium">{{ $tx->payment_status }}</span>
                                        transaction with
                                        <span class="font-medium text-pink-600">
                                            {{ $tx->merchant->merchant_name ?? 'Unknown Merchant' }}
                                        </span>
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $tx->created_at->diffForHumans() }}
                                        ({{ $tx->created_at->format('d M Y, h:i A') }})
                                    </p>
                                </div>
                                <div class="text-sm font-semibold text-green-600">
                                    +{{ number_format($tx->net_amount, 2) }}
                                </div>
                            </div>
                            <hr>
                        @empty
                            <p class="text-sm text-gray-500">No recent transactions found.</p>
                        @endforelse
                    </div>
                </div>


                <!-- Quick Stats (1 column but stacked vertically inside) -->
                <div class="flex flex-col gap-4">
                    <div class="p-4 bg-blue-50 rounded-lg shadow">
                        <p class="text-sm font-medium text-blue-800">New User Registration</p>
                        <p class="text-2xl font-semibold text-blue-600">{{ $quickStats['new_users'] }}</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg shadow">
                        <p class="text-sm font-medium text-green-800">Today's Transaction Amount</p>
                        <p class="text-2xl font-semibold text-green-600">
                            {{ number_format($quickStats['todays_transactions']) }} MMK</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-lg shadow">
                        <p class="text-sm font-medium text-purple-800">Today SMS</p>
                        <p class="text-2xl font-semibold text-purple-600">{{ $quickStats['todays_sms'] }}</p>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-lg shadow">
                        <p class="text-sm font-medium text-yellow-800">Pending Payment</p>
                        <p class="text-2xl font-semibold text-yellow-600">{{ $quickStats['pending_payments'] }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    const colors = {
        primary: '#3b82f6',
        success: '#10b981',
        danger: '#ef4444',
        warning: '#f59e0b',
        info: '#06b6d4',
        dark: '#1f2937',
        light: '#f3f4f6'
    };

    const revenueOptions = {
        series: [{
            name: 'Revenue',
            data: @json($revenueData['data'])
        }],
        chart: {
            type: 'area',
            height: '100%',
            toolbar: {
                show: false,
                tools: {
                    download: true
                }
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        colors: [colors.primary],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.2,
                stops: [0, 90, 100]
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: @json($revenueData['labels']),
            labels: {
                style: {
                    colors: '#6b7280'
                }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { colors: '#6b7280' },
                formatter: value => (value / 1_000_000).toFixed(1) + 'M'
            }
        },
        grid: {
            borderColor: '#e5e7eb',
            strokeDashArray: 4,
            padding: {
                top: 20,
                right: 20,
                bottom: 0,
                left: 20
            }
        },
        tooltip: {
            y: {
                formatter: value => 'MMK ' + value.toLocaleString()
            }
        }
    };

    const userGrowthOptions = {
        series: [{
            name: 'Users',
            data: @json($userGrowthData['data'])
        }],
        chart: {
            type: 'bar',
            height: '100%',
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    reset: true
                }
            }
        },
        colors: [colors.primary],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '70%',
                endingShape: 'rounded'
            }
        },
        dataLabels: { enabled: false },
        xaxis: {
            categories: @json($userGrowthData['labels']),
            labels: {
                style: {
                    colors: '#6b7280'
                }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#6b7280'
                }
            }
        },
        grid: {
            borderColor: '#e5e7eb',
            strokeDashArray: 4
        },
        tooltip: {
            y: {
                formatter: val => val + " new users"
            }
        }
    };

    // Render charts
    const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
    revenueChart.render();

    const userGrowthChart = new ApexCharts(document.querySelector("#userGrowthChart"), userGrowthOptions);
    userGrowthChart.render();
</script>

@endsection
