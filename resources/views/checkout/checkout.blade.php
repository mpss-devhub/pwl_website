<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<style>
    body {
        font-family: "Poppins", sans-serif;
        min-height: 96vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;

    }
</style>

<body class="bg-white flex justify-center items-center  ">
    <div class="w-[450px] bg-[#F1F2F785] shadow-lg  shadow-[#B9C4FC] rounded-xl p-4 space-y-4 border border-[#C0CAFC] ">
        <!-- Logo -->
        <div class="flex justify-center">

            <div class="w-24 h-24  rounded-full flex items-center justify-center text-sm font-semibold">
                <img src="{{ $details['merchant_logo'] }}" alt="" class="" style="border-radius: 100px">
            </div>

        </div>

        <div class="text-[13px] ml-2 text-gray-600 space-y-2">
            <p>Merchant Email : {{ $details['merchant_Cemail'] }}</p>
            <p>Merchant Address : {{ $details['merchant_address'] }}</p>
        </div>

        <div class="border border-[#bdc9fe] rounded-lg p-6 shadow-sm shadow-[#A0B1FF]  bg-[#f9faff]">
            <!-- Invoice Header -->
            <p class="text-center text-[#3C425D] mx-28 font-semibold text-base"
                style="font-family: 'Poppins'">INVOICE</p>

            <div class="space-y-4 mt-8 text-sm text-gray-700" style="font-family: 'Libre Baskerville'">
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
                    <div class="grid grid-cols-3 ">
                        <span class="">Invoice No</span>
                        <span class="text-center">:</span>
                        <span>{{ $links['link_invoiceNo'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 ">
                        <span class="">Expiry Date</span>
                        <span class="text-center">:</span>
                        <span>{{ $links['link_expired_at'] }}</span>
                    </div>
                </div>
                <hr class="border-t border-dotted border-gray-400 my-4">
                <!-- Payment Info -->
                <div class="space-y-2">

                    <div class="grid grid-cols-3">
                        <span class="">Amount</span>
                        <span class="text-center">

                        </span>
                        <span>{{ $links['link_amount'] }} {{ $links['link_currency'] }}</span>
                    </div>

                    <div class="grid grid-cols-3 ">
                        <span class="">Remark</span>
                        <span class="text-center">

                        </span>
                        <span class="">{{ $links['link_description'] }}</span>
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
                        <span>Pay Now</span>
                    </template>
                    <template x-if="loading">
                        <span>
                            <i class="fas fa-spinner fa-spin mr-1"></i> Processing...
                        </span>
                    </template>
                </button>
            </form>
        </div>

        <hr class="border-gray-300" />


        <div class="text-xs text-gray-700 space-y-1">

            <p class=" text-gray-700 text-center">
                <i class="fa-solid fa-bolt-lightning"></i> Power By <a href="https://www.octoverse.com.mm/"
                    class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>
</body>

</html>
