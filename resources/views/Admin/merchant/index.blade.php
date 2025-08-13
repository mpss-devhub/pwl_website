@extends('Admin.layouts.dashboard')
@section('admin_content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    @if (session('user_id') && session('email') && session('password'))
                        confirmButtonText: 'Download Credentials'
                    @else
                        confirmButtonText: 'OK'
                    @endif
                }).then((result) => {
                    @if (session('user_id') && session('email') && session('password'))
                        if (result.isConfirmed) {
                            const content = `Merchant Login Information

----------------------
User ID: {{ session('user_id') }}
Email: {{ session('email') }}
Password: {{ session('password') }}
Login At: www.paywithlink.com/login
----------------------
`;

                            const blob = new Blob([content], {
                                type: 'text/plain'
                            });
                            const link = document.createElement('a');
                            link.href = URL.createObjectURL(blob);
                            link.download = 'credentials.txt';
                            link.click();
                            URL.revokeObjectURL(link.href);
                        }
                    @endif
                });
            });
        </script>
    @endif

    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow mb-6">
                <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800">Merchant List</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div id="filter-content" class="px-6 pb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-800">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20  20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search-input" placeholder="Search by ID, name, email or phone"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Search By</label>
                            <select id="search-type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="all">All Fields</option>
                                <option value="id">Merchant ID</option>
                                <option value="name">Merchant Name</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="contact">Contact Name</option>
                                <option value="status">Status</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="w-full">
                            <a href="{{ route('merchant.create') }}"
                                class="bg-gray-700 hover:bg-gray-800 text-white w-full inline-flex justify-center items-center px-4 py-2 rounded-md transition">
                                <i class="fa-solid fa-user-plus mr-2"></i> Create New Merchant
                            </a>
                        </div>

                        <div class="flex gap-2">
                            <button id="search-button"
                                class="bg-blue-600 hover:bg-blue-700 text-white w-full px-4 py-2 rounded-md flex items-center justify-center">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i> Search
                            </button>
                            <button id="reset-button"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-full px-4 py-2 rounded-md flex items-center justify-center">
                                <i class="fa-solid fa-arrow-rotate-left mr-2"></i> Reset
                            </button>
                        </div>

                        <div class="flex gap-2">
                            <button
                                class="bg-gray-800 hover:bg-gray-700 text-white w-full px-4 py-2 rounded-md flex items-center justify-center">
                                <i class="fa-solid fa-file-csv mr-2"></i> Export CSV
                            </button>
                            <button
                                class="bg-green-600 hover:bg-green-700 text-white w-full px-4 py-2 rounded-md flex items-center justify-center">
                                <i class="fa-solid fa-file-excel mr-2"></i> Export Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Merchant ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Merchant Info
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Contact Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($merchantInfo as $info)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $info->merchant_id ?? 'Waiting Approval' }}</td>
                                    <td class="px-6 py-4 text-gray-500">
                                        <div class="flex items-center">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ $info->merchant_logo ?? Storage::url('common/approved.png') }}"
                                                alt="Logo">
                                            <div class="ml-4 text-sm font-medium merchant-name">{{ $info->merchant_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 merchant-email">{{ $info->merchant_Cemail }}</td>
                                    <td class="px-6 py-4 text-gray-500 merchant-phone">{{ $info->merchant_Cphone }}</td>
                                    <td class="px-6 py-4 text-gray-500 merchant-contact">{{ $info->merchant_Cname }}</td>

                                    <td class="px-6 py-4 merchant-status">
                                        @if ($info->status === 'on')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Active</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <a href="{{ route('merchant.detail', $info->user_id) }}"
                                                class="text-green-600 hover:text-green-900"><i
                                                    class="fa-solid fa-circle-info"></i></a>
                                            @if ($info->merchant_id)
                                                <a href="{{ route('merchant.update', $info->user_id) }}"
                                                    class="text-blue-600 hover:text-blue-900"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('sms.show', $info->user_id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900"><i
                                                        class="fa-solid fa-comment-sms"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="bg-white px-4 py-3 flex flex-col sm:flex-row items-center justify-between border-t border-gray-200">
                    <div class="mt-2 sm:mt-0 sm:ml-auto">
                        {{ $merchantInfo->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter toggle functionality
            const toggleButton = document.getElementById('filter-toggle');
            const filterContent = document.getElementById('filter-content');
            const filterArrow = document.getElementById('filter-arrow');

            // Check localStorage for filter state
            const filterVisible = localStorage.getItem('filterVisible');
            if (filterVisible === 'false') {
                filterContent.classList.add('hidden');
            } else {
                filterContent.classList.remove('hidden');
                filterArrow.classList.add('rotate-180');
            }

            toggleButton.addEventListener('click', function() {
                const isHidden = filterContent.classList.toggle('hidden');
                filterArrow.classList.toggle('rotate-180', !isHidden);
                localStorage.setItem('filterVisible', !isHidden);
            });

            // Search functionality
            const searchInput = document.getElementById('search-input');
            const searchType = document.getElementById('search-type');
            const searchButton = document.getElementById('search-button');
            const resetButton = document.getElementById('reset-button');
            const tableRows = document.querySelectorAll('tbody tr');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();
                const searchField = searchType.value;

                tableRows.forEach(row => {
                    let rowText;

                    if (searchField === 'all') {
                        // Search all columns except actions
                        rowText = Array.from(row.cells)
                            .slice(0, -1) // exclude last cell (actions)
                            .map(cell => cell.textContent.toLowerCase())
                            .join(' ');
                    } else {
                        // Search specific column
                        let cellIndex;
                        switch (searchField) {
                            case 'id':
                                cellIndex = 1;
                                break;
                            case 'name':
                                cellIndex = 2;
                                rowText = row.cells[cellIndex].querySelector('.merchant-name')?.textContent
                                    .toLowerCase() || '';
                                break;
                            case 'email':
                                cellIndex = 3;
                                break;
                            case 'phone':
                                cellIndex = 4;
                                break;
                            case 'contact':
                                cellIndex = 5;
                                break;
                            case 'status':
                                cellIndex = 6;
                                rowText = row.cells[cellIndex].querySelector('span')?.textContent
                                    .toLowerCase() || '';
                                break;
                            default:
                                cellIndex = -1;
                        }

                        if (cellIndex >= 0 && searchField !== 'name' && searchField !== 'status') {
                            rowText = row.cells[cellIndex].textContent.toLowerCase();
                        }
                    }

                    if (rowText.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            searchInput.addEventListener('input', performSearch);
            searchButton.addEventListener('click', performSearch);

            resetButton.addEventListener('click', function() {
                searchInput.value = '';
                searchType.value = 'all';
                tableRows.forEach(row => {
                    row.style.display = '';
                });
            });
        });
    </script>
@endsection
