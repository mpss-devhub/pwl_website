@extends('Admin.layouts.dashboard')
@section('admin_content')
    @if (session('success'))
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
Login At: https://paywithlink.octoverse.com.mm/login
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

            <div class="flex justify-end gap-1">
                <div class="">
                    @if (in_array('C', $access['M'] ?? []))
                        <a href="{{ route('merchant.create') }}"
                            class="bg-gray-700 hover:bg-gray-800  text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs text-white inline-flex justify-center items-center px-4 py-2 rounded-md transition">
                            <i class="fa-solid fa-user-plus mr-2 "></i> Create
                        </a>
                    @endif
                </div>
                <div class="">
                    <a href="{{ route('merchant.show') }}"
                        class="flex-1 bg-gray-400 hover:bg-gray-300  px-4 py-2 rounded-md shadow-sm
                       flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium transition">
                        <i class="fa-solid fa-arrow-rotate-left mr-2"></i> Reset
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow mb-4 mt-2">
                <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                    <h2 class="text-sm md:text-md lg:text-md font-semibold text-gray-800">Merchant List</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div id="filter-content" class="px-6 pb-6 hidden">
                    <form method="GET" action="{{ route('merchant.show') }}" class="">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                            <!-- Search Input -->
                            <div>
                                <label for="search-input"
                                    class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700 mb-1">Search</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" name="search" id="search-input"
                                        placeholder="ID, name, email or phone" value="{{ request('search') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                </div>
                            </div>

                            <!-- Search Type -->
                            <div>
                                <label for="search-type"
                                    class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700 mb-1">Search
                                    By</label>
                                <select name="search_type" id="search-type"
                                    class="block text-gray-800 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                    <option value="all" {{ request('search_type') == 'all' ? 'selected' : '' }}>All
                                        Fields</option>
                                    <option value="id" {{ request('search_type') == 'id' ? 'selected' : '' }}>Merchant
                                        ID</option>
                                    <option value="name" {{ request('search_type') == 'name' ? 'selected' : '' }}>Merchant
                                        Name</option>
                                    <option value="email" {{ request('search_type') == 'email' ? 'selected' : '' }}>Email
                                    </option>
                                    <option value="phone" {{ request('search_type') == 'phone' ? 'selected' : '' }}>Phone
                                    </option>
                                    <option value="contact_name"
                                        {{ request('search_type') == 'contact_name' ? 'selected' : '' }}>Contact Name
                                    </option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="active-status"
                                    class="block text-gray-800 text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700 mb-1">Status</label>
                                <select name="active_status" id="active-status"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs">
                                    <option value="">All</option>
                                    <option value="on" {{ request('active_status') == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="off" {{ request('active_status') == 'inactive' ? 'selected' : '' }}>
                                        Not Active</option>

                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-end gap-1">
                                <button type="submit"
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-2 py-2 rounded-md shadow-sm
                       flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium transition">
                                    <i class="fa-solid fa-magnifying-glass mr-2"></i> Search
                                </button>

                            </div>


                        </div>
                    </form>

                </div>


            </div>


            <div class="bg-white rounded-lg shadow overflow-hidden mt-2">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    ID</th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Merchant ID
                                </th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Profile
                                </th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Email</th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Phone</th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Name
                                </th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Created at</th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Status</th>
                                <th
                                    class="px-3 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider whitespace-nowrap">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($merchantInfo as $info)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 text-xs py-3 text-gray-900 text-center">
                                        {{ ($merchantInfo->currentPage() - 1) * $merchantInfo->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $info->merchant_id ?? 'Waiting Approval' }}</td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        <div class="flex items-center justify-start">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ $info->merchant_logo ?? Storage::url('common/approved.png') }}"
                                                alt="Logo">

                                            <div class="ml-3 text-xs font-medium merchant-name
                     ">
                                                {{ $info->merchant_name }}
                                            </div>
                                        </div>
                                    </td>



                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $info->merchant_Cemail }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $info->merchant_Cphone }}
                                    </td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $info->merchant_Cname }}</td>
                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        {{ $info->created_at }}</td>

                                    <td class="px-6 py-3 text-xs text-center text-gray-500 max-w-xs truncate">
                                        @if ($info->status === 'on')
                                            <span
                                                class="bg-green-100 text-green-800 text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium px-2.5 py-0.5 rounded-full">Active</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-orange-800 text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium px-2.5 py-0.5 rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-center">
                                        <div class="flex justify-center gap-2 text-xs">
                                            @if (in_array('I', $access['M'] ?? []))
                                                <a href="{{ route('merchant.detail', $info->user_id) }}"
                                                    class="text-green-600 hover:text-green-900">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            @endif
                                            @if ($info->merchant_id)
                                                @if (in_array('U', $access['M'] ?? []))
                                                    <a href="{{ route('merchant.update', $info->user_id) }}"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                @endif
                                                @if (in_array('S', $access['M'] ?? []))
                                                    <a href="{{ route('sms.show', $info->user_id) }}"
                                                        class="text-yellow-600 hover:text-yellow-900">
                                                        <i class="fa-solid fa-comment-sms"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 ">
                    {{ $merchantInfo->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection
