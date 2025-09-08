@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200">
        <div class="p-4 rounded-lg mt-14">
            <!-- Stats Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white p-5 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm md:text-md lg:text-md font-medium text-gray-500">Total Users</p>
                            <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800">{{ number_format($totalUsers) }}</p>
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
                            <p class="text-sm md:text-md lg:text-md font-medium text-gray-500">Active Merchants</p>
                            <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800">{{ number_format($activeMerchants) }}</p>
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
                            <p class="text-sm md:text-md lg:text-md font-medium text-gray-500">Total  Amount</p>
                            <div class="flex ">
                                <p class="text-md font-semibold text-gray-800">{{ number_format($totalTransactionAmount) }}
                                    <span class="text-xs text-gray-500">MMK</span></p>
                                  <p class="text-md font-semibold text-gray-800 mx-2">{{ number_format($totalTransactionAmountUSD) }}
                                    <span class="text-xs text-gray-500">USD</span></p>
                            </div>


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
                            <p class="text-sm md:text-md lg:text-md font-medium text-gray-500">Total Transaction</p>
                            <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-gray-800">{{ number_format($totalTransactions) }}</p>
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

            <!-- Revenue Chart -->
            <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-800">Revenue Analytics</h3>
                    <form method="GET" action="{{ route('admin.dashboard') }}" id="filterForm" class="flex gap-2">
                        {{-- Year Filter --}}
                        <label class="flex items-center gap-1 mr-5">
                            <span class="text-sm text-gray-700">Years</span>
                            <select name="year" id="yearSelect"
                                class="py-1 text-center text-sm focus:ring-blue-300 border-0 border-b border-blue-900">
                                <option value="all" {{ request('year') === 'all' ? 'selected' : '' }}>All</option>
                                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </label>

                        {{-- Month Filter --}}
                        <label class="flex items-center gap-1">
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
                <div class="">
                    <div class="flex items-center justify-center h-full bg-gray-50 rounded-md">
                        <div id="AdminrevenueChart" data-revenue='@json($revenueData)' class="w-full"
                            style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <!-- User Growth Chart -->
            <div class="bg-white p-6 rounded-lg shadow border border-gray-100 mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-800">User Growth</h3>

                </div>

                <div class="">
                    <!-- Chart container - Replace with your actual chart implementation -->
                    <div id="AdminuserGrowthChart" data-user-growth='@json($userGrowthData)' class="w-full"
                        style="height: 350px;"></div>
                </div>
            </div>
            <!-- Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-3">
                <!-- Recent Activities (Spanning 2 columns) -->
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100 lg:col-span-2">
                    <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-800 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        @forelse($latestTransactions as $tx)
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800 text-[11px] sm:text-[11px] md:text-[10px] lg:text-xs">
                                            {{ $tx->link->link_name ?? 'Unknown User' }}
                                        </span>
                                        made a
                                        <span class="font-medium text-[11px] sm:text-[11px] md:text-[10px] lg:text-xs">{{ $tx->payment_status }}</span>
                                        transaction with
                                        <span class="font-medium text-pink-500 text-[11px] sm:text-[11px] md:text-[10px] lg:text-xs">
                                            {{ $tx->created_by ?? 'Unknown Merchant' }}
                                        </span>
                                    </p>
                                    <p class="text-xs text-gray-400 text-[11px] sm:text-[11px] md:text-[10px] lg:text-xs">
                                        {{ $tx->updated_at->diffForHumans() }}
                                        ({{ $tx->updated_at->format('d M Y, h:i A') }})
                                    </p>
                                </div>
                                <div class="text-sm font-semibold text-green-600 text-[11px] sm:text-[11px] md:text-[10px] lg:text-xs">
                                    +{{ number_format($tx->req_amount, 2) }}
                                </div>
                            </div>
                            <hr>
                        @empty
                            <p class="text-sm text-gray-500">No recent transactions found.</p>
                        @endforelse
                    </div>
                </div>


                <!-- Quick Stats (1 column but stacked vertically inside) -->
                <div class="flex flex-col gap-4 ">
                    <div class="p-6 bg-blue-50 rounded-lg shadow">
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-medium text-blue-800">New User Registration</p>
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-blue-600">{{ $quickStats['new_users'] }}</p>
                    </div>
                    <div class="p-6 bg-green-50 rounded-lg shadow">
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-medium text-green-800">Today's Transaction Amount</p>
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-green-600">
                            {{ number_format($quickStats['todays_transactions']) }} MMK</p>
                    </div>
                    <div class="p-6 bg-purple-50 rounded-lg shadow">
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-medium text-purple-800">Today Created Link</p>
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-purple-600">{{ $quickStats['todays_sms'] }}</p>
                    </div>
                    <div class="p-6 bg-yellow-50 rounded-lg shadow">
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-medium text-yellow-800">Pending To Pay</p>
                        <p class="text-[11px] sm:text-[11px] md:text-[10px] lg:text-sm font-semibold text-yellow-600">{{ $quickStats['pending_payments'] }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
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
