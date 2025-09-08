@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow mb-6">
                <button id="filter-toggle" class="w-full flex justify-between items-center p-4 sm:p-6 focus:outline-none">
                    <h2 class="text-sm md:text-md lg:text-md font-semibold text-gray-800">Filter Transactions</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <form action="{{ route('merchant.tnx') }}" method="GET">
                    <!-- Filter Content -->
                    <div id="filter-content" class="px-4 sm:px-6 pb-6 hidden">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Date Range -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Start Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" id="start_date" name="start_date"
                                        value="{{ request('start_date') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md
                   leading-5 bg-white placeholder-gray-500 focus:outline-none
                   focus:ring-blue-500 focus:border-blue-500 sm:text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">End Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="datetime-local" id="end_date" name="end_date"
                                        value="{{ request('end_date') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md
                   leading-5 bg-white placeholder-gray-500 focus:outline-none
                   focus:ring-blue-500 focus:border-blue-500 sm:text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Payment Method</label>
                                <select id="payment-method" name="payment_method"
                                    class="w-full text-gray-800 px-3 py-2 border border-gray-300  rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                    <option value="">All Methods</option>
                                    @foreach ($paymentMethods as $method)
                                        <option value="{{ $method }}">{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Status</label>
                                <select id="status" name="status"
                                    class="w-full text-gray-800 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                    <option value="">All Statuses</option>
                                    <option value="SUCCESS">SUCCESS</option>
                                    <option value="FAIL">FAIL</option>
                                    <option value="Pending">PENDING</option>
                                </select>
                            </div>
                        </div>
                        <!-- Search & Actions -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <!-- Search -->
                            <div class="space-y-2">
                                <label for="search" class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-800">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search" name="search"
                                        placeholder="Search by ID, name or phone"
                                        class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-end gap-2">
                                <button id="search-btn"
                                    class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Search
                                </button>
                                <button id="reset-btn" type="button"
                                    class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Reset
                                </button>
                            </div>

                            <di v class="flex items-end gap-2">
                                <a href="{{ route('merchant.csv.export') }}"
                                    class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Export CSV
                                </a>

                                <a href="{{ route('merchant.tnx.export') }}"
                                    class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Export Excel
                                </a>
                            </di>
                        </div>
                </form>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                ID
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Invoice No
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Name
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Amount
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Currency
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-start text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Paymentmethod
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Status
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Paid At
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="transactions-body" class="bg-white divide-y divide-gray-200">
                        @foreach ($tnx as $item)
                            <tr class="transaction-row hover:bg-gray-50">
                                <td class="px-3 text-center py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium text-gray-900">
                                    {{ ($tnx->currentPage() - 1) * $tnx->perPage() + $loop->iteration }}
                                </td>
                                <td
                                    class="px-3 text-center py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500 ">
                                    {{ $item->tranref_no }}
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    <div class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-900 ">
                                        {{ $item->payment_user_name }}</div>
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    <div class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-900">{{ $item->req_amount }}</div>
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    <div class="text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-900">MMK</div>
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    <div class="flex items-center ">
                                        <img src="{{ $item->payment_logo }}" alt="Logo" class="h-8 w-8 rounded">
                                        <span class="ml-2 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium">{{ $item->paymentCode }}</span>
                                    </div>
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    @if ($item->payment_status == 'SUCCESS')
                                        <span
                                            class="px-2 inline-flex text-[6px] md:text-[8px] lg:text-[9px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $item->payment_status }}
                                        </span>
                                    @elseif ($item->payment_status == 'FAIL')
                                        <span
                                            class="px-2 inline-flex text-[6px] md:text-[8px] lg:text-[9px] leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $item->payment_status }}
                                        </span>
                                    @elseif ($item->payment_status == 'PENDING')
                                        <span
                                            class="px-2 inline-flex text-[6px] md:text-[8px] lg:text-[9px] leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ $item->payment_status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500">
                                    @if ($item->trans_date_time)
                                        {{ \Carbon\Carbon::parse($item->trans_date_time)->format('M d, Y h:i A') }}
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td class="px-3 text-center py-3 whitespace-nowrap">
                                    <div class="flex space-x-1">
                                        <form action="{{ route('tnx.detail') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}" required>
                                            <button
                                                class=" px-2 py-1 hover:bg-green-800 rounded text-green-700 hover:text-white">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('Payment.detail') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}" required>
                                            <button
                                                class=" px-2 py-1 hover:bg-blue-800 rounded text-blue-700 hover:text-white">
                                                <i class="fa-solid fa-building-columns"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $tnx->links('pagination::tailwind') }}
        </div>
    </div>
    </div>
@endsection
