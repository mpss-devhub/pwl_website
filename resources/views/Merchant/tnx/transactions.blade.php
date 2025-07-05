@extends('Merchant.layouts.dashboard')
@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow mb-6">
                <button id="filter-toggle" class="w-full flex justify-between items-center p-4 sm:p-6 focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800">Filter Transactions</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Filter Content -->
                <div id="filter-content" class="px-4 sm:px-6 pb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Date Range -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="start-date"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">End Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="end-date"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <select id="payment-method"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">All Methods</option>
                                @foreach ($tnx->pluck('paymentCode')->unique() as $method)
                                    <option value="{{ $method }}">{{ $method }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">All Statuses</option>
                                <option value="SUCCESS">SUCCESS</option>
                                <option value="FAIL">FAIL</option>
                                <option value="Pending">PENDING</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search & Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="space-y-2 md:col-span-1">
                            <label class="block text-sm font-medium text-gray-800">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search" placeholder="Search by ID, invoice or name"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-end gap-2 md:col-span-2">
                            <div class="flex gap-2 w-full">
                                <button id="search-btn"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors w-full sm:w-auto flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Search
                                </button>
                                <button id="reset-btn"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition-colors w-full sm:w-auto flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Reset
                                </button>
                            </div>

                            <div class="flex gap-2 w-full">
                                <button
                                    class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors w-full sm:w-auto flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <a href="{{ route('merchant.csv.export') }}">Export CSV</a>

                                </button>
                                <button
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors w-full sm:w-auto flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <a href="{{ route('merchant.tnx.export') }}"> Export  Excel</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
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
                                <tr class="transaction-row hover:bg-gray-50" data-id="{{ $loop->iteration }}"
                                    data-invoice="{{ $item->tranref_no }}" data-name="{{ $item->payment_user_name }}"
                                    data-amount="{{ $item->req_amount }}" data-currency="MMK"
                                    data-method="{{ $item->paymentCode }}" data-status="{{ $item->payment_status }}"
                                    data-date="{{ $item->trans_date_time ? \Carbon\Carbon::parse($item->trans_date_time)->format('Y-m-d H:i:s') : '' }}">
                                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration }}
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
                                            <form action="{{ route('tnx.detail') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}"
                                                    required>
                                                <button
                                                    class=" px-2 py-1 hover:bg-green-800 rounded text-green-700 hover:text-white">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('Payment.detail') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}"
                                                    required>
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

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle filter visibility
            const toggleButton = document.getElementById('filter-toggle');
            const filterContent = document.getElementById('filter-content');
            const filterArrow = document.getElementById('filter-arrow');

            toggleButton.addEventListener('click', function() {
                const isHidden = filterContent.classList.toggle('hidden');
                filterArrow.classList.toggle('rotate-180', !isHidden);
                localStorage.setItem('filterVisible', !isHidden);
            });

            // Check localStorage for saved state
            const filterVisible = localStorage.getItem('filterVisible');
            if (filterVisible === 'false') {
                filterContent.classList.add('hidden');
                filterArrow.classList.remove('rotate-180');
            }

            // Filter transactions function
            function filterTransactions() {
                const startDate = document.getElementById('start-date').value;
                const endDate = document.getElementById('end-date').value;
                const paymentMethod = document.getElementById('payment-method').value;
                const status = document.getElementById('status').value;
                const searchTerm = document.getElementById('search').value.toLowerCase();

                const rows = document.querySelectorAll('.transaction-row');

                rows.forEach(row => {
                    const rowDate = row.dataset.date;
                    const rowMethod = row.dataset.method;
                    const rowStatus = row.dataset.status;
                    const rowInvoice = row.dataset.invoice.toLowerCase();
                    const rowName = row.dataset.name.toLowerCase();
                    const rowId = row.dataset.id.toString();

                    // Date filter
                    let dateMatch = true;
                    if (startDate && rowDate) {
                        dateMatch = new Date(rowDate) >= new Date(startDate + 'T00:00:00');
                    }
                    if (endDate && rowDate) {
                        dateMatch = dateMatch && new Date(rowDate) <= new Date(endDate + 'T23:59:59');
                    }

                    // Payment method filter
                    const methodMatch = !paymentMethod || rowMethod === paymentMethod;

                    // Status filter
                    const statusMatch = !status || rowStatus === status;

                    // Search filter
                    const searchMatch = !searchTerm ||
                        rowInvoice.includes(searchTerm) ||
                        rowName.includes(searchTerm) ||
                        rowId.includes(searchTerm);

                    // Show/hide row based on filters
                    if (dateMatch && methodMatch && statusMatch && searchMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Reset filters function
            function resetFilters() {
                document.getElementById('start-date').value = '';
                document.getElementById('end-date').value = '';
                document.getElementById('payment-method').value = '';
                document.getElementById('status').value = '';
                document.getElementById('search').value = '';

                document.querySelectorAll('.transaction-row').forEach(row => {
                    row.style.display = '';
                });
            }

            // Event listeners
            document.getElementById('search-btn').addEventListener('click', filterTransactions);
            document.getElementById('reset-btn').addEventListener('click', resetFilters);

            // Filter on input change
            document.getElementById('search').addEventListener('input', filterTransactions);
            document.getElementById('payment-method').addEventListener('change', filterTransactions);
            document.getElementById('status').addEventListener('change', filterTransactions);
            document.getElementById('start-date').addEventListener('change', filterTransactions);
            document.getElementById('end-date').addEventListener('change', filterTransactions);
        });
    </script>
@endsection
