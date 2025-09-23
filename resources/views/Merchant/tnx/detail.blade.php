@extends('Merchant.layouts.dashboard')

@section('merchant_content')
    <div class="p-4 sm:ml-64 bg-gray-100 min-h-screen">
        <div class="p-4 mt-14">
            <!-- Link Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6">

                <!-- Header -->
                <div
                    class="px-5 py-4 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-white">
                    <div class="flex items-center gap-3">
                        <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-24 sm:w-28" alt="">
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap gap-2 w-full sm:w-auto">
                        <a href="{{ url()->previous() }}"
                            class="flex items-center px-3 py-1.5 bg-gray-100 text-gray-800 text-xs font-medium rounded-md hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>

                        <form action="{{ route('Payment.detail') }}" method="POST">
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
                <div class="p-4 text-sm overflow-x-auto">
                    <div
                        class="min-w-[700px] md:min-w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 bg-white rounded-xl shadow-sm p-5">

                        <!-- Left Column -->
                        <div class="flex flex-col gap-2 sm:gap-4 border rounded-lg p-2 sm:p-4 bg-gray-50 min-w-[280px]">
                            <h3 class="text-xs  sm:text-sm font-semibold text-gray-700">Click Info</h3>
                            <div class="space-y-1 sm:space-y-2 text-[11px] sm:text-xs">
                                <div>
                                    <span class="font-medium text-gray-600">Country Flag:</span>
                                    @if (isset($click[0]['info']['country_flag']))
                                        <img src="{{ $click[0]['info']['country_flag'] }}" alt="Country Flag"
                                            class="w-5 h-3 inline-block mx-1">
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <div><span class="font-medium text-gray-600">Link Click At:</span>
                                    {{ $click[0]['created_at'] ?? 'N/A' }}</div>
                                <div><span class="font-medium text-gray-600">IP Address:</span>
                                    {{ $click[0]['ip_address'] ?? 'N/A' }}</div>
                                <div><span class="font-medium text-gray-600">Location:</span>
                                    {{ $click[0]['info']['country'] ?? 'N/A' }}, {{ $click[0]['info']['city'] ?? 'N/A' }}
                                </div>
                                <div><span class="font-medium text-gray-600">Country Code:</span>
                                    {{ $click[0]['info']['country_phone'] ?? 'N/A' }}</div>
                                <div><span class="font-medium text-gray-600">Provider Name:</span>
                                    {{ $click[0]['info']['provider'] ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="flex flex-col gap-2 sm:gap-4 border p-3 sm:p-4 rounded-lg bg-gray-50 min-w-[280px]">
                            <h3 class="text-xs  sm:text-sm font-semibold text-gray-700">Payment Link Info</h3>
                            <div class="space-y-1 sm:space-y-2 text-[11px] sm:text-xs">
                                <div><span class="font-medium text-gray-600">Customer Name:</span>
                                    {{ $links['link_name'] }}</div>
                                <div><span class="font-medium text-gray-600">Phone:</span> {{ $links['link_phone'] }}</div>
                                <div><span class="font-medium text-gray-600">Email:</span> {{ $links['link_email'] }}</div>
                                <div><span class="font-medium text-gray-600">Amount:</span>
                                    {{ $links['link_currency'] . ' ' . $links['link_amount'] }}</div>
                                <div><span class="font-medium text-gray-600">Type:</span>
                                    {{ match ($links['link_type']) {'C' => 'Copy','Q' => 'QR','S' => 'SMS','E' => 'Email',default => 'Unknown'} }}
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Status:</span>
                                    <span
                                        class="{{ $links['link_status'] === 'active' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
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
                    <p class="text-gray-700 text-xs">{{ $links['link_description'] }}</p>
                </div>

                <!-- Link URL Section -->
                <div class="px-5 py-3 border-t bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Payment Link</label>
                        <span class="text-xs text-gray-500">Expires: {{ $links['link_expired_at'] }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center rounded-md shadow-sm gap-2">
                        <input type="text" value="{{ $links['link_url'] }}" id="paymentLink"
                            class="flex-1 min-w-0 block w-full px-3 py-2 text-xs border border-gray-300 rounded-md sm:rounded-r-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            readonly>
                        <button onclick="copyToClipboard()"
                            class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 rounded-md sm:rounded-l-none transition-colors">
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
