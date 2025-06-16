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
                <img src="{{ $merchant->merchant_logo }}" alt="Merchant Logo" />
            </div>
        </div>

        <!-- Merchant Info -->
        <div class="text-sm text-gray-700 space-y-1">
            <p><strong>Merchant Name:</strong> {{ $merchant->merchant_name }}</p>
            <p><strong>Invoice No:</strong> {{ $link->link_invoiceNo }}</p>
            <p><strong>To:</strong> {{ $link->link_name }}</p>
            <div class="flex">
                <p><strong>Amount:</strong> {{ $link->link_amount }} </p> <small
                    class="text-red-500 mx-2">{{ $link->link_expired_at }}</small>
            </div>
        </div>

        <hr class="border-gray-300" />

        <!-- Payment Methods Tabs -->
        <div class="text-center text-gray-800">

            @if ($data)


                @if (is_string($data))
                    <p class="text-sm text-gray-700">{{ $data }}</p>
                @elseif (is_array($data))
                    @if (!empty($data['qrImg']))
                        <div class="flex justify-center items-center">
                            <img src="{{ $data['qrImg'] }}" alt="QR Code" class="w-48 h-48 mx-auto" />
                        </div>
                        <p class="text-sm text-center">Please scan this QR to pay.</p>
                    @endif


                    @if (!empty($data['redirectUrl']))
                        <div class="text-center mt-4">
                            <p class="text-sm text-center">Please Pay Throught this Link </p>
                            <a href="{{ $data['redirectUrl'] }}" class="text-blue-600 text-center">Go to Payment
                                Link</a>
                        </div>
                    @endif


                @endif

            @endif


        </div>

        <hr class="border-gray-300" />

        <div class="text-sm text-gray-700 space-y-1">
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Sender Email:</strong> example@store.com</p>
                <p><strong>Sender Address:</strong> Yangon, Myanmar</p>
            </div>
        </div>
        <p class="text-sm text-gray-700 text-center"> octoverse@gmail.com</p>
    </div>


</body>

</html>
