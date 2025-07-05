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
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="bg-white flex justify-center items-center  p-4">
    <div
        class="w-full max-w-[450px] bg-[#F1F2F785] shadow-lg shadow-[#B9C4FC] rounded-xl p-4 space-y-4 border border-[#C0CAFC]">
        <!-- Logo -->
        <div class="flex justify-center">
            <div class="w-24 h-24 rounded-full flex items-center justify-center text-sm font-semibold">
                <img src="{{ $merchant->merchant_logo }}" alt="Merchant Logo" style="border-radius: 100px" />
            </div>
        </div>
        <div class="text-[13px] ml-2 text-gray-600 space-y-2">
            <p>Merchant Email : {{ $merchant->merchant_Cemail }}</p>
            <p>Merchant Address : {{ $merchant->merchant_address }}</p>
        </div>

        @if ($data)
            @if (is_string($data))
                <div class="border border-[#bdc9fe] rounded-lg p-6 shadow  bg-[#f9faff]">
                    <!-- Invoice Header -->
                    <div class="text-center">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="inline w-9 h-9 text-gray-200 animate-spin dark:text-gray-600 fill-yellow-400"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="text-gray-700 text-sm text-center py-2 mt-4" x-data>
                            You will receive pay request notification at your mobile wallet and make a confirm payment
                            at your mobile wallet to complete the payment.
                        </p>
                    </div>
                    <hr class="border-t border-dotted border-gray-400 my-3">

                    <div class="text-sm mt-2 text-gray-700" style="font-family: 'Libre Baskerville'">
                        <!-- Merchant Info -->
                        <div class="space-y-2">
                            <div class="grid grid-cols-3">
                                <span>Customer Name</span>
                                <span class="text-center">:</span>
                                <span class="font-medium">{{ $link->link_name }}</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span>Invoice No</span>
                                <span class="text-center">:</span>
                                <span>{{ $link->link_invoiceNo }}</span>
                            </div>

                            <div class="grid grid-cols-3">
                                <span>Amount</span>
                                <span class="text-center">:</span>
                                <span>{{ $link->link_amount }} {{ $link->link_currency }}</span>
                            </div>
                        </div>
                        <hr class="border-t border-dotted border-gray-400 my-4">

                    </div>

                </div>
            @elseif (is_array($data))
                @if (!empty($data['qrImg']))
                    <div class="border border-[#bdc9fe] rounded-lg p-6 shadow  bg-[#f9faff]">
                        <!-- Invoice Header -->
                        <div class="text-center text-gray-800">
                            <div class="flex justify-center ">
                                <img src="{{ $data['qrImg'] }}"
                                    alt="QR Code" class="w-48 h-48 mx-auto" />
                            </div>
                            <p class="text-sm text-center py-2" x-data>
                            <div role="status" class="inline">
                                <svg aria-hidden="true"
                                    class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-yellow-400"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            Please scan this QR to pay. Or
                            <a href="{{ $data['qrImg'] }}" @click.prevent="downloadQR"
                                class="text-blue-600 hover:underline">Download</a>
                            </p>
                        </div>
                        <hr class="border-t border-dotted border-gray-400 my-3">

                        <div class="text-sm mt-2 text-gray-700" style="font-family: 'Libre Baskerville'">
                            <!-- Merchant Info -->
                            <div class="space-y-2">
                                <div class="grid grid-cols-3">
                                    <span>Customer Name</span>
                                    <span class="text-center">:</span>
                                    <span class="font-medium">{{ $link->link_name }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span>Invoice No</span>
                                    <span class="text-center">:</span>
                                    <span>{{ $link->link_invoiceNo }}</span>
                                </div>

                                <div class="grid grid-cols-3">
                                    <span>Amount</span>
                                    <span class="text-center">:</span>
                                    <span>{{ $link->link_amount }} {{ $link->link_currency }}</span>
                                </div>
                            </div>
                            <hr class="border-t border-dotted border-gray-400 my-4">

                        </div>

                    </div>
                    <script>
                        function downloadQR() {
                            const link = document.createElement('a');
                            link.href = {{ $data['qrImg'] }};
                            link.download = "QR-Code.png"; // file name
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                    </script>
                @endif
                @if (!empty($data['redirectUrl']))
                    <div class="border border-[#bdc9fe] rounded-lg p-6 shadow  bg-[#f9faff]">
                        <!-- Invoice Header -->
                        <div class="text-center">
                            <div role="status">
                                <svg aria-hidden="true"
                                    class="inline w-9 h-9 text-gray-200 animate-spin dark:text-gray-600 fill-yellow-400"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="text-gray-700 text-sm">
                                <p class=" text-center py-2 mt-4" x-data>
                                    Web and Card Payment can be pay through this button for safe and secure payment .
                                </p>
                                <button
                                    class="mt-1 shadow-sm border py-2 px-3 rounded-lg hover:bg-[#C2CDF1] text-white bg-[#7589E1]">
                                    <a href="">Click Me</a>
                                </button>
                            </div>
                        </div>
                        <hr class="border-t border-dotted border-gray-400 my-3">

                        <div class="text-sm mt-2 text-gray-700" style="font-family: 'Libre Baskerville'">
                            <!-- Merchant Info -->
                            <div class="space-y-2">
                                <div class="grid grid-cols-3">
                                    <span>Customer Name</span>
                                    <span class="text-center">:</span>
                                    <span class="font-medium">{{ $link->link_name }}</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <span>Invoice No</span>
                                    <span class="text-center">:</span>
                                    <span>{{ $link->link_invoiceNo }}</span>
                                </div>

                                <div class="grid grid-cols-3">
                                    <span>Amount</span>
                                    <span class="text-center">:</span>
                                    <span>{{ $link->link_amount }} {{ $link->link_currency }}</span>
                                </div>
                            </div>
                            <hr class="border-t border-dotted border-gray-400 my-4">

                        </div>

                    </div>
                @endif
            @endif
        @endif
                    @if (!$data)
                        Please Connect to admin
                        <a href=""><i class="fa-solid fa-triangle-exclamation bg-red-600"></i></a>
                    @endif
        <div class="text-xs text-gray-700 space-y-1">

            <p class=" text-gray-700 text-center">
                <i class="fa-solid fa-bolt-lightning"></i> Power By <a href="https://www.octoverse.com.mm/"
                    class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
</body>

</html>
