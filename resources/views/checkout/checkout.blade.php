<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<style>
    body {
        font-family: "Poppins", sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        min-height: 100vh;
    }
</style>

<body class="bg-white flex justify-center items-center min-h-screen ">
    <div class="w-[500px] bg-[#F1F2F785] shadow-xl rounded-xl p-4 space-y-4 border border-[#C0CAFC] ">
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

        <div class="border border-[#bdc9fe] rounded-lg p-5 shadow-md space-y-4 bg-[#f9faff]">
            <!-- Invoice Header -->
            <p class="text-center text-gray-700 font-semibold text-base" style="font-family: 'Poppins'">INVOICE</p>

            <div class="space-y-4 text-md text-gray-700" style="font-family: 'Libre Baskerville'">
                <!-- Merchant Info -->
                <div class="space-y-2" >
                    <div class="flex justify-between">
                        <span>Merchant Name</span>
                        <span class="font-medium">{{ $details['merchant_name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Invoice No</span>
                        <span>{{ $links['link_invoiceNo'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Expiry Date</span>
                        <span>{{ $links['link_expired_at'] }}</span>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="border-t pt-3 space-y-4">
                    <div class="flex justify-between">
                        <span>To</span>
                        <span class="font-medium">{{ $links['link_name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Amount</span>
                        <span>{{ $links['link_amount'] }} {{ $links['link_currency'] }}</span>
                    </div>

                    <div class="flex justify-between ">
                        <span>Remark</span>
                        <span class="text-end">{{ $links['link_description'] }}</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-center" >
            <form action="{{ route('Auth') }}" method="post">
                @csrf
                <input type="hidden" name="link_id" value="{{ $links['id'] }}">
                <button class="bg-[#637AE2] border-[#B6C2F8] text-white px-3 py-2 rounded-md shadow hover:bg-[#7a87bb]">
                Pay Now
                </button>
            </form>

        </div>
        <hr class="border-gray-300" />


        <div class="text-sm text-gray-700 space-y-1">

            <p class="text-sm text-gray-700 text-center">
              <i class="fa-solid fa-bolt-lightning"></i> Power By <a href="https://www.octoverse.com.mm/" class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>
</body>

</html>
