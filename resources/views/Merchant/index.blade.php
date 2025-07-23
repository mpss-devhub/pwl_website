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
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Total Revenue</p>
                            <p class="text-xl sm:text-2xl font-semibold text-gray-800">MMK {{ $TotalMMK }}</p>
                        </div>
                        <div class="p-2 sm:p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Transactions Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Transactions</p>
                            <p class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $TotalTnx }}</p>
                           <div class="flex space-x-3">
                             <p class="text-xs text-green-500 mt-1">{{$TotalSuccess}} Success</p>
                             <p class="text-xs text-red-500 mt-1">{{ $TotalFailed }} Failed</p>
                             <p class="text-xs text-yellow-500 mt-1">{{ $TotalPending }} Pending</p>

                           </div>
                        </div>
                        <div class="p-2 sm:p-3 rounded-full bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Success Rate Card -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Success Rate</p>
                            <p class="text-xl sm:text-2xl font-semibold text-gray-800">{{ $SuccessRate }}%</p>
                           <div class=" text-xs mt-1">
                             <span class=" text-green-500 mt-1">{{$TotalSuccess}} Tnx </span>
                                <span>Success at </span>
                            <span class=" text-red-500 mt-1">{{$Totallink}} Links </span> created
                           </div>
                        </div>
                        <div class="p-2 sm:p-3 rounded-full bg-purple-50 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Chart - Improved Responsiveness -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                <div class="">
                    <form method="GET" action="{{ route('merchant.dashboard') }}">
    <label for="filter">View by:</label>
    <select name="filter" id="filter" onchange="this.form.submit()" class="border border-gray-300 rounded-md py-1">
        <option value="weekly" {{ $filter == 'weekly' ? 'selected' : '' }}>Weekly</option>
        <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Monthly</option>
        <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Yearly</option>
    </select>
</form>

                </div>
                <div id="revenueChart" class="w-full" style="min-height: 300px;"></div>
            </div>

            <!-- Bottom Row - Improved Responsiveness -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <!-- Transaction Types Table - Improved Responsiveness -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100 overflow-x-auto">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Most Used Payment Type</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Name</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Count</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($Mostuse as $item)
                                    <tr>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-2 whitespace-nowrap">
                                            <img src="{{ $item->payment_logo }}" alt="{{ $item->paymentCode }}" class="w-8 sm:w-10 rounded-md">
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->paymentCode }}</td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Transactions Table - Improved Responsiveness -->
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border border-gray-100 overflow-x-auto">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Transactions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice No</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($Latest as $item)
                                    <tr>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate max-w-[120px] sm:max-w-none">{{ $item->tranref_no }}</td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->req_amount }}</td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap">
                                            @if ($item->payment_status == 'SUCCESS')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Success</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->created_by }}</td>
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
        chart: {
            type: 'area',
            height: '100%',
            width: '100%',
            toolbar: { show: true },
            zoom: { enabled: false },
            animations: { enabled: false },
            sparkline: { enabled: false }
        },
        colors: ['#3b82f6'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: {
            categories: @json($revenueData['labels']),
            labels: { style: { fontSize: '12px' } }
        },
        yaxis: {
            labels: {
                formatter: function(value) { return (value / 1000000).toFixed(1) + 'M'; },
                style: { fontSize: '12px' }
            }
        },
        tooltip: {
            enabled: true,
            y: { formatter: function(value) { return 'MMK ' + value.toLocaleString(); } }
        },
        grid: { show: true, borderColor: '#f0f0f0', strokeDashArray: 0 }
    };

    try {
        const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    } catch (error) {
        console.error("Error rendering chart:", error);
    }
});
</script>
@endsection
