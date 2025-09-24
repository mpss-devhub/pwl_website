@extends('Admin.layouts.dashboard')
@section('admin_content')
    @include('Admin.links.alert')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <div class="bg-white rounded-lg shadow mb-6">
                <!-- Filter Header with Toggle -->
                <button id="filter-toggle" class="w-full flex justify-between items-center p-6 focus:outline-none">
                    <h2 class="text-sm md:text-md lg:text-md font-semibold text-gray-800">Link History</h2>
                    <svg id="filter-arrow" class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>


                <!-- Filter Content -->
                <div id="filter-content" class="px-4 sm:px-6 pb-6 hidden">
                    <form method="GET" action="{{ route('admin.links') }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Start Date -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Start Date</label>
                                <input type="datetime-local" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                            </div>

                            <!-- End Date -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">End Date</label>
                                <input type="datetime-local" id="end_date" name="end_date"
                                    value="{{ request('end_date') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                            </div>

                            <!-- Notification Type -->
                            <div class="space-y-2">
                                <label class="block text-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Notification Method</label>
                                <select name="notification_type"
                                    class="w-full text-gray-800 px-3 py-2 border border-gray-300 rounded-md
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                                    <option value="">All Methods</option>
                                    <option value="C" {{ request('notification_type') == 'C' ? 'selected' : '' }}>Copy
                                        Link</option>
                                    <option value="S" {{ request('notification_type') == 'S' ? 'selected' : '' }}>SMS
                                    </option>
                                    <option value="E" {{ request('notification_type') == 'E' ? 'selected' : '' }}>Email
                                    </option>
                                    <option value="Q" {{ request('notification_type') == 'Q' ? 'selected' : '' }}>QR
                                    </option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="space-y-2">
                                <label class="block ext-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Status</label>
                                <select name="status"
                                    class="w-full text-gray-800 px-3 py-2 border border-gray-300 rounded-md
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                                    <option value="">All Statuses</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Search & Buttons -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                            <!-- Search -->
                            <div class="space-y-2">
                                <label class="block ext-[9px] sm:text-[9px] md:text-[10px] lg:text-xs font-medium text-gray-700">Search</label>
                                <input type="text" name="search" placeholder="Search by ID, name or phone"
                                    value="{{ request('search') }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md
                           transition-colors w-full flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                                    Search
                                </button>
                                <a href="{{ route('admin.links') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md
                           transition-colors w-full flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                                    Reset
                                </a>
                            </div>

                            <!-- Export Buttons -->
                            @if (in_array('E', $access['L'] ?? []))
                                <div class="flex items-end gap-2">
                                    <a href="{{ route('admin.link.csv.export') }}?{{ http_build_query(request()->all()) }}"
                                        class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md
                           transition-colors w-full flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">

                                       <span class="block md:hidden lg:block mr-1">Export</span> CSV
                                    </a>
                                    <a href="{{ route('admin.link.tnx.export') }}?{{ http_build_query(request()->all()) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md
                           transition-colors w-full flex items-center justify-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px]">
                                        <span class="block md:hidden lg:block mr-1">Export</span> Excel
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="link-table">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Message</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">To</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Status
                                </th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Click</th>
                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Created At</th>

                                <th class="px-6 py-3 text-center text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="links-body">
                            @foreach ($links as $item)
                                <tr class="link-row hover:bg-gray-50">
                                    <td class="px-6 text-center py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium text-gray-900">
                                      {{ ($links->currentPage() - 1) * $links->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 text-center  py-3 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500 max-w-xs truncate">{{ $item->link_url }}
                                    </td>
                                    <td class="px-6 text-center  py-3 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500 max-w-xs truncate">{{ $item->link_phone }}
                                    </td>
                                    <td class="px-6 text-center  py-3 text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500 max-w-xs truncate">{{ $item->link_name }}
                                    </td>
                                    <td class="px-6 text-center  py-3 whitespace-nowrap">
                                        @switch($item->link_type)
                                            @case('S')
                                                <span
                                                    class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">SMS</span>
                                            @break

                                            @case('C')
                                                <span
                                                    class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">Copy</span>
                                            @break

                                            @case('Q')
                                                <span
                                                    class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">QR</span>
                                            @break

                                            @case('E')
                                                <span
                                                    class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-green-100 text-green-800">Email</span>
                                            @break

                                            @default
                                                <span
                                                    class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 text-center  py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500">
                                        @if ($item->link_status === 'active')
                                            <span
                                                class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-gray-100 text-blue-800">Active</span>
                                        @elseif ($item->link_status === 'expired')
                                            <span
                                                class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold rounded-full bg-red-100 text-red-800">Expired</span>
                                        @endif
                                    </td>
                                    <td class="px-6 text-center  py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500">
                                        <p class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold">
                                            {{ $item->link_click_status === 'Clicked' ? 'Clicked' : 'Unclick' }}
                                        </p>
                                    </td>
                                      <td class="px-6 text-center  py-3 whitespace-nowrap text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] text-gray-500">
                                        <p class="px-2 inline-flex text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] leading-5 font-semibold">
                                            {{ $item->created_at }}
                                        </p>
                                    </td>
                                    <td class="px-6   py-3 whitespace-nowrap text-right text-[9px] sm:text-[9px] md:text-[10px] lg:text-[11px] font-medium">
                                        <div class="flex space-x-3">
                                            @if (in_array('V', $access['L'] ?? []))
                                                <form action="{{ route('admin.sms.details',request()->query()) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit"
                                                        class="text-blue-600 hover:text-blue-900">View</button>
                                                </form>
                                            @endif
                                            @if (in_array('R', $access['L'] ?? []))
                                                <form action="{{ route('admin.sms.resent',request()->query()) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">Resend</button>
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
            <!-- Pagination -->
            <div class="mt-3">
                {{ $links->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
