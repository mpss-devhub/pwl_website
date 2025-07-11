@extends('Admin.layouts.dashboard')
@section('admin_content')
    @include('Admin.links.alert')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow mb-6">
                <!-- Filter Header with Toggle -->
                <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800">Link History</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Filter Content -->
                <div id="filter-content" class="px-6 pb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Start Date -->
                        <div class="space-y-2">
                            <label for="start-date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="start-date" name="start-date"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="space-y-2">
                            <label for="end-date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="end-date" name="end-date"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Notification Type -->
                        <div class="space-y-2">
                            <label for="notification-type" class="block text-sm font-medium text-gray-700">Notification</label>
                            <select id="notification-type" name="notification-type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">All Methods</option>
                                <option value="C">Copy Link</option>
                                <option value="S">SMS</option>
                                <option value="E">Email</option>
                                <option value="Q">QR</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search & Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <!-- Search -->
                        <div class="space-y-2">
                            <label for="search" class="block text-sm font-medium text-gray-800">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" placeholder="Search by ID, name or phone"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-end gap-2">
                            <button id="search-btn"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                                Search
                            </button>
                            <button id="reset-btn"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                                Reset
                            </button>
                        </div>

                        <div class="flex items-end gap-2">
                            <a href="{{ route('admin.link.csv.export') }}"
                                class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Export CSV
                            </a>

                            <a href="{{ route('admin.link.tnx.export') }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Export Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="link-table">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Message</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">To</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Link Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Link Track</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="links-body">
                            @foreach ($links as $item)
                                <tr class="link-row hover:bg-gray-50"
                                    data-id="{{ $loop->iteration }}"
                                    data-message="{{ $item->link_url }}"
                                    data-to="{{ $item->link_phone }}"
                                    data-name="{{ $item->link_name }}"
                                    data-type="{{ $item->link_type }}"
                                    data-status="{{ $item->link_status }}"
                                    data-track="{{ $item->link_click_status }}"
                                    data-date="{{ $item->created_at }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->link_url }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->link_phone }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->link_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($item->link_type)
                                            @case('S')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">SMS</span>
                                                @break
                                            @case('C')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Copy</span>
                                                @break
                                            @case('Q')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">QR</span>
                                                @break
                                            @case('E')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Email</span>
                                                @break
                                            @default
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($item->link_status === 'active')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-blue-800">Active</span>
                                        @elseif ($item->link_status === 'expired')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <p class="px-2 inline-flex text-sm leading-5 font-semibold">
                                            {{ $item->link_click_status === 'Clicked' ? 'Clicked' : 'Unclick' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <form action="{{ route('admin.sms.details') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="text-blue-600 hover:text-blue-900">View</button>
                                            </form>
                                            <form action="{{ route('admin.sms.resent') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="text-red-600 hover:text-red-900">Resend</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle filter visibility
            const toggleButton = document.getElementById('filter-toggle');
            const filterContent = document.getElementById('filter-content');
            const filterArrow = document.getElementById('filter-arrow');

            toggleButton.addEventListener('click', function () {
                const isHidden = filterContent.classList.toggle('hidden');
                filterArrow.classList.toggle('rotate-180', !isHidden);
                localStorage.setItem('filterVisible', !isHidden);
            });

            // Restore filter visibility from localStorage
            const filterVisible = localStorage.getItem('filterVisible');
            if (filterVisible === 'false') {
                filterContent.classList.add('hidden');
                filterArrow.classList.remove('rotate-180');
            }

            // Filter function
            function filterLinks() {
                const startDate = document.getElementById('start-date').value;
                const endDate = document.getElementById('end-date').value;
                const notificationType = document.getElementById('notification-type').value;
                const status = document.getElementById('status').value;
                const searchTerm = document.getElementById('search').value.toLowerCase();

                document.querySelectorAll('.link-row').forEach(row => {
                    const rowDate = row.dataset.date;
                    const rowType = row.dataset.type;
                    const rowStatus = row.dataset.status;
                    const rowMessage = row.dataset.message.toLowerCase();
                    const rowTo = row.dataset.to.toLowerCase();
                    const rowName = row.dataset.name.toLowerCase();
                    const rowId = row.dataset.id.toString();

                    // Date filter
                    let dateMatch = true;
                    if (startDate && rowDate) {
                        dateMatch = new Date(rowDate) >= new Date(startDate);
                    }
                    if (endDate && rowDate) {
                        dateMatch = dateMatch && new Date(rowDate) <= new Date(endDate);
                    }

                    // Notification type filter
                    const typeMatch = !notificationType || rowType === notificationType;

                    // Status filter
                    const statusMatch = !status || rowStatus === status;

                    // Search filter
                    const searchMatch = !searchTerm ||
                        rowMessage.includes(searchTerm) ||
                        rowTo.includes(searchTerm) ||
                        rowName.includes(searchTerm) ||
                        rowId.includes(searchTerm);

                    // Show/hide row
                    row.style.display = (dateMatch && typeMatch && statusMatch && searchMatch) ? '' : 'none';
                });
            }

            // Reset function
            function resetFilters() {
                document.getElementById('start-date').value = '';
                document.getElementById('end-date').value = '';
                document.getElementById('notification-type').value = '';
                document.getElementById('status').value = '';
                document.getElementById('search').value = '';

                document.querySelectorAll('.link-row').forEach(row => row.style.display = '');
            }

            // Event listeners
            document.getElementById('search-btn').addEventListener('click', filterLinks);
            document.getElementById('reset-btn').addEventListener('click', resetFilters);
            document.getElementById('search').addEventListener('input', filterLinks);
            document.getElementById('notification-type').addEventListener('change', filterLinks);
            document.getElementById('status').addEventListener('change', filterLinks);
            document.getElementById('start-date').addEventListener('change', filterLinks);
            document.getElementById('end-date').addEventListener('change', filterLinks);
        });
    </script>
@endsection
