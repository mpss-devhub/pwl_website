<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Success</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/checkout/style.css') }}">
    <script src="{{ asset('common/checkout/js/checkout.js') }}"></script>
    <script src="{{ asset('common/checkout/js/prevent.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
</head>

<body class="p-4">
    <div id="exportArea"
        class="w-full max-w-[450px] bg-[#F1F2F785] shadow-lg shadow-[#B9C4FC] rounded-xl p-4 sm:p-6 space-y-4 sm:space-y-6 border border-[#C0CAFC]">
        <!-- Logo -->
        <div class="flex justify-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full flex items-center justify-center">
                <img src="{{ $merchant['merchant_logo'] }}" alt="Merchant Logo" crossorigin="anonymous"
                    class="rounded-full w-full h-full object-cover" />
            </div>
        </div>

        <div class="text-xs sm:text-[13px] text-gray-600 space-y-1 sm:space-y-2 px-2">
            <p class="truncate">Merchant Email: {{ $merchant['merchant_Cemail'] }}</p>
            <p class="truncate">Merchant Address: {{ $merchant['merchant_address'] }}</p>
        </div>

        <!-- Merchant Info -->
        <div class="border border-[#bdc9fe] rounded-lg p-6 shadow bg-[#f9faff]"
            style="font-family: 'Libre Baskerville'">
            @if ($tnx['payment_status'] == 'SUCCESS')
                <div class="flex items-center justify-center space-x-2">
                    <p class="text-center text-gray-700 font-medium">Payment Success</p>
                    <i class="fa-solid fa-circle-check text-green-500 text-md"></i>
                </div>
            @endif
            <div class="text-xs sm:text-sm mt-3 text-gray-700">
                <!-- Merchant Info -->
                <div class="space-y-1">
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Merchant Name</span>
                        <span class="text-center">:</span>
                        <span class="font-medium truncate">{{ $merchant['merchant_name'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Customer Name</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['payment_user_name'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Amount</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['req_amount'] }}{{ $tnx['currencyCode'] }}</span>
                    </div>
                </div>

                <hr class="border-t border-dotted border-gray-400 my-3 sm:my-4">

                <div class="space-y-1">
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Invoice</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['tranref_no'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Trans No</span>
                        <span class="text-center">:</span>
                        <span class="font-medium truncate">{{ $tnx['bank_tranref_no'] }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="truncate">Amount</span>
                        <span class="text-center">:</span>
                        <span class="truncate">{{ $tnx['req_amount'] }}</span>
                    </div>
                </div>
                <div class="flex justify-end mt-2 mx-6">
                    <img src="{{ Storage::url('common/success.png') }}" class="w-16 h-16 sm:w-24 sm:h-24 "
                        alt="Success Image">
                </div>

                <div class="flex justify-evenly mt-2 sm:mt-2" id='btn'>
                    <button
                        class="bg-[#cacaca] py-2 px-4 rounded-md text-dark hover:bg-[#c4c4d0] transition text-[13px] border border-dotted">
                        <a href="{{ $merchant['merchant_frontendURL'] }}">
                            <i class="fa-solid fa-arrow-left mt-2"></i> Return Back
                        </a>
                    </button>
                    <button onclick="downloadAsPNG()"
                        class="bg-[#637AE2] py-2 px-4 rounded-md text-white hover:bg-[#5469c0] transition text-xs sm:text-base">
                        Save Image
                    </button>
                </div>
            </div>
        </div>

        <div class="text-xs text-gray-700 text-center">
            <p>
                Power By <a href="https://www.octoverse.com.mm/" class="text-[#8a9adb]">Octoverse.com.mm</a>
            </p>
        </div>
    </div>
    <script>
        function downloadAsPNG() {
            const element = document.getElementById("exportArea");

            html2canvas(element, {
                scale: 3,
                useCORS: true,
                backgroundColor: "#fff",
                scrollX: 0,
                scrollY: 0,
                width: element.offsetWidth,
                height: element.scrollHeight,
                onclone: (clonedDoc) => {
                    // Hide btn to remove from png
                    const clonedBtn = clonedDoc.getElementById("btn");
                    if (clonedBtn) clonedBtn.style.display = "none";

                    const clonedExport = clonedDoc.getElementById("exportArea");
                    clonedExport.style.maxWidth = "450px";
                    clonedExport.style.width = "450px";
                    clonedExport.style.overflow = "visible";

                    //  text
                    const truncated = clonedDoc.querySelectorAll("#exportArea .truncate");
                    truncated.forEach(el => {
                        el.style.overflow = "visible";
                        el.style.whiteSpace = "normal";
                        el.style.textOverflow = "clip";
                    });

                    //  shrinking img
                    const imgs = clonedDoc.querySelectorAll("#exportArea img");
                    imgs.forEach(img => {
                        img.style.maxWidth = "none";
                        img.style.maxHeight = "none";
                    });
                }
            }).then((canvas) => {
                const link = document.createElement("a");
                link.download = "payment.png";
                link.href = canvas.toDataURL("image/png");
                link.click();
            });
        }
    </script>
</body>

</html>
