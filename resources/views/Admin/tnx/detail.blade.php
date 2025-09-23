@extends('Admin.layouts.dashboard')
@section('admin_content')
    <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
        <div class="p-4 mt-14">
            <!-- Link Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Header -->
                <div
                    class="px-5 py-4 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-28" alt="">
                    </div>

                    <div class="flex gap-2 w-full sm:w-auto">
                        <a href="{{ route('tnx.show') }}"
                            class="flex items-center px-3 py-1.5 bg-gray-100 text-gray-800 text-xs font-medium rounded-md hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>

                        <form action="{{ route('admin.Payment.detail') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit"
                                class="flex items-center px-3 py-1.5 bg-gray-800 text-white text-xs font-medium rounded-md hover:bg-gray-700 transition-colors">
                                <i class="fa-solid fa-building-columns mr-1.5 text-xs"></i> Bank Info
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Link Info Grid -->
                <div class="p-4 text-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white rounded-xl shadow-sm p-5">
                        <!-- Left Column -->
                        <div class="flex flex-col gap-4 border rounded-lg p-4 bg-gray-50 ">
                            <div class="flex items-center gap-2">

                                <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-700">Click Info</h3>
                            </div>

                            <div class="space-y-3 ">
                                <div><span class="text-xs font-medium text-gray-600">Country Flag:</span>
                                    @if (isset($click[0]['info']['country_flag']))
                                        <img src="{{ $click[0]['info']['country_flag'] }}" alt="Country Flag"
                                            class="w-6 h-4 inline-block mx-1">
                                    @else
                                        <span class="text-xs">N/A</span>
                                    @endif
                                </div>
                                <div><span class="text-xs font-medium text-gray-600">Link Click At:</span>
                                    <span class="text-xs"> {{ $click[0]['created_at'] ?? 'N/A' }}</span>
                                </div>
                                <div><span class="text-xs font-medium text-gray-600">IP Address:</span>
                                    <span class="text-xs"> {{ $click[0]['ip_address'] ?? 'N/A' }} </span>
                                </div>
                                <div><span class="text-xs font-medium text-gray-600">Location:</span>

                                    <span class="text-xs"> {{ $click[0]['info']['country'] ?? 'N/A' }}, </span>
                                    <span class="text-xs"> {{ $click[0]['info']['city'] ?? 'N/A' }}
                                    </span>
                                </div>

                                @php
                                    $linkTypeText = match ($links['link_type']) {
                                        'C' => 'Copy',
                                        'Q' => 'QR',
                                        'S' => 'SMS',
                                        'E' => 'Email',
                                        default => 'Unknown',
                                    };
                                @endphp

                                <div><span class="text-xs font-medium text-gray-600">Country Code:</span>
                                    <span class="text-xs"> {{ $click[0]['info']['country_phone'] ?? 'N/A' }}
                                </div></span>
                                <div>
                                    <span class="text-xs font-medium text-gray-600">Provider Name:</span>
                                    <span class="text-xs">
                                        {{ $click[0]['info']['provider'] ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="flex flex-col gap-4 border p-4 rounded-lg bg-gray-50 ">
                            <h3 class="text-sm md:text-md lg:text-md font-semibold text-gray-700 ">Payment Link Info</h3>
                            <div class="space-y-3 text-sm">
                                <div><span class="font-medium text-gray-600 text-xs">Customer Name:</span>
                                    <span class="text-xs"> {{ $links['link_name'] }}</span>
                                </div>
                                <div><span class="font-medium text-gray-600 text-xs">Phone:</span> <span
                                        class="text-xs">{{ $links['link_phone'] }}</span></div>
                                <div><span class="font-medium text-gray-600 text-xs">Email:</span> <span
                                        class="text-xs">{{ $links['link_email'] }}</span></div>
                                <div><span class="font-medium text-gray-600 text-xs">Amount:</span>
                                    <span
                                        class="text-xs">{{ $links['link_currency'] . ' ' . $links['link_amount'] }}</span>
                                </div>
                                <div><span class="font-medium text-gray-600 text-xs">Type:</span> {{ $linkTypeText }}</div>
                                <div>
                                    <span class="font-medium text-gray-600 text-xs">Status:</span>
                                    <span
                                        class="{{ $links['link_status'] === 'active' ? 'text-green-600 font-semibold text-xs' : 'text-red-600 font-semibold text-xs' }}">
                                        {{ ucfirst($links['link_status']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Description -->
                <div class="px-5 py-3 border-t bg-gray-50">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Description</h4>
                    <p class="text-sm text-gray-700">{{ $links['link_description'] }}</p>
                </div>

                <!-- Link URL Section -->
                <div class="px-5 py-3 border-t bg-gray-50">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Payment Link</label>
                        <span class="text-xs text-gray-500">Expires: {{ $links['link_expired_at'] }}</span>
                    </div>

                    <div class="flex rounded-md shadow-sm">
                        <input type="text" value="{{ $links['link_url'] }}" id="paymentLink"
                            class="flex-1 min-w-0 block w-full px-3 py-2 text-xs border border-gray-300 rounded-l-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            readonly>
                        <button onclick="copyToClipboard()"
                            class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 rounded-r-md transition-colors">
                            Copy
                        </button>
                    </div>
                    <p id="copyMsg" class="mt-1 text-xs text-green-600 h-4 transition-opacity duration-150 opacity-0">
                        Copied to clipboard!</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const input = document.getElementById("paymentLink");
            navigator.clipboard.writeText(input.value).then(() => {
                const msg = document.getElementById("copyMsg");
                msg.classList.remove("opacity-0");
                setTimeout(() => msg.classList.add("opacity-0"), 1500);
            });
        }
    </script>
@endsection
