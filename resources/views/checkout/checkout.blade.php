<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-[360px] bg-white shadow-lg rounded-xl p-4 space-y-4 border">
        <!-- Logo -->
        <div class="flex justify-center">

            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-sm font-semibold">
                <img src="{{ $details['merchant_logo'] }}" alt="">
            </div>

        </div>

        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Merchant Name:</strong> {{ $details['merchant_name'] }}</p>
            <p><strong>Invoice No:</strong> {{ $links['link_invoiceNo'] }}</p>
            <p><strong>Expiry Date:</strong> {{ $links['link_expired_at'] }}</p>

        </div>

        <hr class="border-gray-300" />

        <!-- Payment Methods -->
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>To :</strong>{{ $links['link_name'] }}</p>
            <p><strong>Amount:</strong> {{ $links['link_amount'] }} {{ $links['link_currency'] }}</p>
            <p><strong>Remark:</strong> {{ $links['link_description'] }}</p>
        </div>

        <div class="flex justify-center">
            <form action="{{ route('Auth') }}" method="post">
                @csrf
                <input type="hidden" name="link_id" value="{{ $links['id'] }}">
                <button class="bg-blue-600 text-white px-2 py-1 rounded-md shadow hover:bg-blue-700">
                    Pay Now
                </button>
            </form>

        </div>
        <hr class="border-gray-300" />


        <div class="text-sm text-gray-700 space-y-1">


            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Sender Email:</strong> {{ $details['merchant_Cemail'] }}</p>
                <p><strong>Sender Address:</strong> {{ $details['merchant_address'] }}</p>
            </div>

            <p class="text-sm text-gray-700 text-center"> octoverse@gmail.com</p>
        </div>
    </div>
</body>

</html>
