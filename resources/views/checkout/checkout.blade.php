@extends('checkout.layout.index')
@section('checkout')
    <!-- Logo -->
    <div class="flex justify-center">
        <div class="w-20 h-20  sm:w-24 sm:h-24  rounded-full flex items-center justify-center text-sm font-semibold">
            <img src="{{ $details['merchant_logo'] }}" alt="" class="" style="border-radius: 100px">
        </div>
    </div>

    <div class="text-[10px] sm:text-[11px] ml-2 text-gray-600 space-y-2">
        <p>Merchant Email : {{ $details['merchant_Cemail'] }}</p>
        <p>Merchant Address : {{ $details['merchant_address'] }}</p>
    </div>

    <div class="border border-[#bdc9fe] rounded-lg p-6 shadow-sm shadow-[#A0B1FF]  bg-[#f9faff]">
        <!-- Invoice Header -->
        <p class="text-center text-[#3C425D] mx-28  font-semibold text-xs sm:text-sm" style="font-family: 'Poppins'">INVOICE
        </p>

        <div class="space-y-4 mt-6 text-[11px] sm:text-[12px] text-gray-700" style="font-family: 'Libre Baskerville'">
            <!-- Merchant Info -->
            <div class="space-y-2">
                <div class="grid grid-cols-3 ">
                    <span class="">Merchant Name</span>
                    <span class="text-center">:</span>
                    <span class="font-medium">{{ $details['merchant_name'] }}</span>
                </div>
                <div class="grid grid-cols-3">
                    <span class="">Customer Name</span>
                    <span class="text-center">:</span>
                    <span class="font-medium">{{ $links['link_name'] }}</span>
                </div>
                <div class="grid grid-cols-3 items-start gap-1">
                    <span>Invoice No</span>
                    <span class="text-center">:</span>
                    <span class="truncate" title="{{ $links['link_invoiceNo'] }}">
                        {{ $links['link_invoiceNo'] }}
                    </span>
                </div>

                <div class="grid grid-cols-3">
                    <span class="">Amount</span>
                    <span class="text-center">:</span>
                    <span>{{ $links['link_amount'] }} {{ $links['link_currency'] }}</span>
                </div>
                <div class="grid grid-cols-3 ">
                    <span class="">Expiry Date</span>
                    <span class="text-center">:</span>
                    <span>{{ $links['link_expired_at'] }}</span>
                </div>
            </div>
            <hr class="border-t border-dotted border-gray-400 my-4">
            <!-- Payment Info -->
            <div class="">

                <div class="space-y-2">

                    @if (strlen($links['link_description']) <= 20)

                        <div class="grid grid-cols-3">
                            <span>Remark</span>
                            <span class="text-center">:</span>
                            <span>{{ $links['link_description'] }}</span>
                        </div>
                    @else

                        <div class="grid grid-cols-3">
                            <span class="col-span-3 text-center font-medium">Remark</span>
                            <span class="col-span-3 mt-1 text-center text-gray-600">
                                {{ $links['link_description'] }}
                            </span>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>


    <div class="flex justify-center" x-data="{ loading: false }">
        <form action="{{ route('Auth') }}" method="post" @submit="loading = true">
            @csrf
            <input type="hidden" name="link_id" value="{{ $links['id'] }}">
            <button type="submit" :disabled="loading"
                class="bg-[#637AE2] border-[#B6C2F8] shadow-[#7589E1] shadow text-white px-4 py-2 rounded-md  hover:bg-[#7a87bb] flex items-center justify-center space-x-2">
                <template x-if="!loading">
                    <span class="text-xs sm:text-sm">Pay Now</span>
                </template>
                <template x-if="loading">
                    <span>
                        <i class="fas fa-spinner fa-spin mr-1  text-xs sm:text-sm"></i> Processing...
                    </span>
                </template>
            </button>
        </form>
    </div>
@endsection
