@extends('Admin.layouts.dashboard')
@section('admin_content')
@if(session('success') && session('user_id') && session('email') && session('password'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Download Credentials'
            }).then((result) => {
                if (result.isConfirmed) {
                    const content = `User ID: {{ session('user_id') }}\nEmail: {{ session('email') }}\nPassword: {{ session('password') }}`;
                    const blob = new Blob([content], { type: 'text/plain' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'credentials.txt';
                    link.click();
                    URL.revokeObjectURL(link.href);
                }
            });
        });
    </script>
@elseif (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

<div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
    <div class="p-4 mt-14">
        <div class="bg-white rounded-lg shadow mb-6">
            <!-- Filter Header with Toggle -->
            <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                <h2 class="text-lg font-semibold text-gray-800">User List Filter</h2>
                <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Filter Content (Initially visible) -->
            <div id="filter-content" class="px-6 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search Field -->
                    <div class="space-y-2">
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
                            <input type="text" id="search-input" placeholder="Search by ID, name, email or phone"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Search Type -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Search By</label>
                        <select id="search-type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="all">All Fields</option>
                            <option value="id">User ID</option>
                            <option value="name">Name</option>
                            <option value="group">User Group</option>
                            <option value="phone">Phone</option>
                            <option value="email">Email</option>
                            <option value="status">Status</option>
                        </select>
                    </div>

                    <!-- User Group Filter -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">User Group</label>
                        <select id="user-group-filter"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">All Groups</option>
                            @foreach($per as $item)
                            <option value="{{ $item->id }}">{{$item->user_group}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Search & Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div class="flex justify-end">
                        <div class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md transition-colors flex items-center">
                            <a href="{{ route('user.create') }}" class="text-decoration-none">
                                <i class="fa-solid fa-user-plus mx-2"></i> Add User
                            </a>
                        </div>
                    </div>

                    <div class="flex items-end gap-2">
                        <button id="search-button"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                        <button id="reset-button"
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
                        <button
                            class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Export CSV
                        </button>
                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors w-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Search functionality
                const searchInput = document.getElementById('search-input');
                const searchType = document.getElementById('search-type');
                const userGroupFilter = document.getElementById('user-group-filter');
                const searchButton = document.getElementById('search-button');
                const resetButton = document.getElementById('reset-button');
                const tableRows = document.querySelectorAll('tbody tr');

                function performSearch() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const searchField = searchType.value;
                    const selectedGroup = userGroupFilter.value;

                    tableRows.forEach(row => {
                        let rowText = '';
                        let rowGroup = row.querySelector('td:nth-child(4)')?.textContent.trim() || '';

                        // Check user group filter first
                        if (selectedGroup && rowGroup !== document.querySelector(`#user-group-filter option[value="${selectedGroup}"]`)?.textContent.trim()) {
                            row.style.display = 'none';
                            return;
                        }

                        if (searchField === 'all') {
                            // Search all columns except actions
                            rowText = Array.from(row.cells)
                                .slice(0, -1) // exclude last cell (actions)
                                .map(cell => cell.textContent.toLowerCase())
                                .join(' ');
                        } else {
                            // Search specific column
                            let cellIndex;
                            switch(searchField) {
                                case 'id': cellIndex = 1; break; // User ID column
                                case 'name':
                                    // For name which is inside a div in the 3rd column
                                    cellIndex = 2;
                                    rowText = row.cells[cellIndex].querySelector('.text-sm.font-medium')?.textContent.toLowerCase() || '';
                                    break;
                                case 'group': cellIndex = 3; break;
                                case 'phone': cellIndex = 4; break;
                                case 'email': cellIndex = 5; break;
                                case 'status':
                                    // Status is in a span in the 6th column
                                    cellIndex = 6;
                                    rowText = row.cells[cellIndex].querySelector('span')?.textContent.toLowerCase() || '';
                                    break;
                                default: cellIndex = -1;
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

                // Search on input change or button click
                searchInput.addEventListener('input', performSearch);
                searchButton.addEventListener('click', performSearch);
                userGroupFilter.addEventListener('change', performSearch);

                // Reset search
                resetButton.addEventListener('click', function() {
                    searchInput.value = '';
                    searchType.value = 'all';
                    userGroupFilter.value = '';
                    tableRows.forEach(row => {
                        row.style.display = '';
                    });
                });
            });
        </script>

        <!-- User Table Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                User ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                User Info
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                User Group
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ $admin->user_id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ Storage::url('common/undraw_profile.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ optional($admin->permission)->user_group }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{$admin->phone}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $admin->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($admin->status == 'on')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Active
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.show.update',$admin->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('user.delete',$admin->id) }}" class="text-red-600 hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-end">
                    <div>
                        <nav class="relative z-0 flex justify-between rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            {{ $admins->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
