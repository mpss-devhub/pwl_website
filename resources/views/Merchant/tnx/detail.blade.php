@extends('Merchant.layouts.dashboard')

@section('merchant_content')
<div class="p-4 sm:ml-64 bg-gray-50 min-h-screen">
    <div class="p-4 mt-14">
        <!-- Link Details Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-5 py-4 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-white">
                <div class="flex items-center gap-3">
                    @if (!empty($logo['merchant_logo']))
                        <img src="{{ $logo['merchant_logo'] }}" class="w-10 h-10 rounded-full border border-gray-200 object-cover" alt="Merchant Logo">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Payment Link</h3>
                        <p class="text-xs text-gray-500">Details for invoice #{{ $links['link_invoiceNo'] }}</p>
                    </div>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <a href="{{ url()->previous() }}" class="flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>

                    <form action="{{ route('Payment.detail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fa-solid fa-building-columns mr-1.5 text-xs"></i> Pay Now
                        </button>
                    </form>
                </div>
            </div>

            <!-- Link Info Grid -->
            <div class="px-5 py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Left Column -->
                <div class="space-y-3">
                    <x-info-row label="Customer Name" :value="$links['link_name']"/>
                    <x-info-row label="Phone" :value="$links['link_phone']"/>
                    <x-info-row label="Email" :value="$links['link_email']"/>
                </div>

                <!-- Right Column -->
                <div class="space-y-3">
                    <x-info-row label="Amount" :value="$links['link_currency'] . ' ' . $links['link_amount']"/>
                    @php
                        $linkTypeText = match($links['link_type']) {
                            'C' => 'Copy',
                            'Q' => 'QR',
                            'S' => 'SMS',
                            'E' => 'Email',
                            default => 'Unknown'
                        };
                    @endphp
                    <x-info-row label="Type" :value="$linkTypeText"/>
                    <x-info-row label="Status" :value="$links['link_status']" :status="$links['link_status'] === 'active' ? 'success' : 'danger'"/>
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
                    <input type="text"
                           value="{{ $links['link_url'] }}"
                           id="paymentLink"
                           class="flex-1 min-w-0 block w-full px-3 py-2 text-xs border border-gray-300 rounded-l-md focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                           readonly>
                    <button onclick="copyToClipboard()"
                            class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 rounded-r-md transition-colors">
                        Copy
                    </button>
                </div>
                <p id="copyMsg" class="mt-1 text-xs text-green-600 h-4 transition-opacity duration-150 opacity-0">Copied to clipboard!</p>
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
