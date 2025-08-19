@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">


            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Transactions -->
                <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Transactions</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $total }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Successful Transactions -->
                <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Successful</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $Success }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Failed Transactions -->
                <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Failed</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $Fail }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-red-50 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Amount</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $SuccessTotal }} MMK</p>
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
            </div>

            <div class="bg-white rounded-lg shadow ">
                <button id="filter-toggle" class="w-full flex justify-between items-center p-4 sm:p-6 focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800">Filter Transactions</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414
                            1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0
                            010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Filter Content -->
                <div id="filter-content" class="px-4 sm:px-6 pb-6 hidden">
                    <form method="GET" action="{{ route('tnx.show') }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Start Date -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="datetime-local" name="start_date" value="{{ request('start_date') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- End Date -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="datetime-local" name="end_date" value="{{ request('end_date') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!-- Payment Method -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="payment_method"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">All Methods</option>
                                    @foreach ($tnx->pluck('paymentCode')->unique() as $method)
                                        <option value="{{ $method }}"
                                            {{ request('payment_method') == $method ? 'selected' : '' }}>
                                            {{ $method }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">All Statuses</option>
                                    <option value="SUCCESS" {{ request('status') == 'SUCCESS' ? 'selected' : '' }}>SUCCESS
                                    </option>
                                    <option value="FAIL" {{ request('status') == 'FAIL' ? 'selected' : '' }}>FAIL
                                    </option>
                                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>PENDING
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Search & Buttons -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <!-- Search -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" placeholder="Search by ID, name or phone"
                                    value="{{ request('search') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <!--  Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md
                               transition-colors w-full flex items-center justify-center">
                                    Search
                                </button>
                                <a href="{{ route('tnx.show') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md
                               transition-colors w-full flex items-center justify-center">
                                    Reset
                                </a>
                            </div>

                            <!-- Export Buttons -->
                            @if (in_array('E', $access['T'] ?? []))
                                 <div class="flex items-end gap-2">
                                <a href="{{ route('admin.merchant.tnx.export') }}"
                                    class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md
                               transition-colors w-full flex items-center justify-center">
                                    Export CSV
                                </a>
                                <a href="{{ route('admin.merchant.csv.export') }}"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md
                               transition-colors w-full flex items-center justify-center">
                                    Export Excel
                                </a>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="p-4">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Merchant ID
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Invoice No
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Currency
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Payment
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Paid At
                                </th>

                                    <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap">
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody id="transactions-body" class="bg-white divide-y divide-gray-200">
                            @foreach ($tnx as $item)
                                <tr class="transaction-row hover:bg-gray-50">
                                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-[100px]">
                                        {{ $item->created_by }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-[100px]">
                                        {{ $item->tranref_no }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 truncate max-w-[120px]">
                                            {{ $item->payment_user_name }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->req_amount }}</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">MMK</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ $item->payment_logo }}" alt="Logo" class="h-8 w-8 rounded">
                                            <span class="ml-2 text-sm font-medium">{{ $item->paymentCode }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        @if ($item->payment_status == 'SUCCESS')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $item->payment_status }}
                                            </span>
                                        @elseif ($item->payment_status == 'FAIL')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ $item->payment_status }}
                                            </span>
                                        @elseif ($item->payment_status == 'Pending')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $item->payment_status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($item->trans_date_time)
                                            {{ \Carbon\Carbon::parse($item->trans_date_time)->format('M d, Y h:i A') }}
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="flex space-x-1">
                                            @if (in_array('TD', $access['T'] ?? []))
                                                <form action="{{ route('admin.tnx.detail') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}"
                                                        required>
                                                    <button
                                                        class=" px-2 py-1  rounded text-green-700 ">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if (in_array('P', $access['T'] ?? []))
                                                <form action="{{ route('admin.Payment.detail') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}"
                                                        required>
                                                    <button
                                                        class=" px-2 py-1  rounded text-blue-700 ">
                                                        <i class="fa-solid fa-building-columns"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $tnx->links('pagination::tailwind') }}
        </div>
    @endsection
