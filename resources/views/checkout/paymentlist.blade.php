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
          <img src="/logo.png" alt="Merchant Logo" />
        </div>
      </div>

      <!-- Merchant Info -->
      <div class="text-sm text-gray-700 space-y-1">
        <p><strong>Merchant Name:</strong> Shwe Nyar Myay</p>
        <p><strong>Invoice No:</strong> INV-123456</p>
        <p><strong>To:</strong> Htet Linn Aung</p>
        <div class="flex">
          <p><strong>Amount:</strong> 20000 MMK </p> <small class="text-red-500 mx-2">( Expire at 16/5/2025 )</small>
        </div>

      </div>

      <hr class="border-gray-300" />

      <!-- Payment Methods Tabs -->
      <div class="text-center text-gray-800">
        <p class="mb-2 font-medium">Payment Method</p>

        <div class="flex border-b border-gray-200">
          <button
            id="pin-tab"
            class="flex-1 py-2 px-4 font-medium border-b-2 border-transparent hover:text-blue-500 hover:border-blue-300 active-tab"
            onclick="switchTab('pin')"
          >
            PIN
          </button>
          <button
            id="qr-tab"
            class="flex-1 py-2 px-4 font-medium border-b-2 border-transparent hover:text-blue-500 hover:border-blue-300"
            onclick="switchTab('qr')"
          >
            QR
          </button>
          <button
            id="web-tab"
            class="flex-1 py-2 px-4 font-medium border-b-2 border-transparent hover:text-blue-500 hover:border-blue-300"
            onclick="switchTab('web')"
          >
            WEB
          </button>
           <button
            id="card-tab"
            class="flex-1 py-2 px-4 font-medium border-b-2 border-transparent hover:text-blue-500 hover:border-blue-300"
            onclick="switchTab('card')"
          >
            CARD
          </button>
        </div>

        <!-- Tab Contents -->
        <div class="mt-4">
          <!-- PIN Content -->
          <div id="pin-content" class="tab-content">

           <a href="/success.html">
             <div class="grid grid-cols-4 gap-4 mb-4">
              <img src="/a.png" alt="Payment Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/mo.png" alt="Payment Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/uab.png" alt="Payment Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/c.png" alt="Payment Option" class="w-12 h-12 object-cover rounded-lg">
            </div>
           </a>
            <p class="text-sm text-gray-600">Enter your PIN to complete payment</p>
          </div>

          <!-- QR Content -->
          <div id="qr-content" class="tab-content hidden">

            <a href="/success.html">
              <div class="grid grid-cols-4 gap-4 mb-4">
              <img src="/on.png" alt="QR Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/mo.png" alt="QR Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/a.png" alt="QR Option" class="w-12 h-12 object-cover rounded-lg">
                  <img src="/k.png" alt="QR Option" class="w-12 h-12 object-cover rounded-lg">
            </div>
            </a>
            <p class="text-sm text-gray-600">Scan this QR code to pay</p>
          </div>

          <!-- WEB Content -->
          <div id="web-content" class="tab-content hidden">

            <a href="/success.html">
              <div class="grid grid-cols-4 gap-4 mb-4">
              <img src="/o.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/w.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/mp.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">

            </div>
            </a>
            <p class="text-sm text-gray-600">You'll be redirected to payment page</p>
          </div>
          <div id="card-content" class="tab-content hidden">
            <a href="/success.html">
            <div class="grid grid-cols-4 gap-4 mb-4">
              <img src="/mpu.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/jcb.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">
              <img src="/vsm.png" alt="Web Option" class="w-12 h-12 object-cover rounded-lg">

            </div>
            </a>
            <p class="text-sm text-gray-600">You'll be redirected to payment page</p>
          </div>
        </div>
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

    <script>
      function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
          content.classList.add('hidden');
        });

        // Remove active style from all tabs
        document.querySelectorAll('[id$="-tab"]').forEach(tab => {
          tab.classList.remove('text-blue-500', 'border-blue-500', 'active-tab');
          tab.classList.add('border-transparent');
        });

        // Show selected tab content
        document.getElementById(`${tabName}-content`).classList.remove('hidden');

        // Add active style to selected tab
        const activeTab = document.getElementById(`${tabName}-tab`);
        activeTab.classList.add('text-blue-500', 'border-blue-500', 'active-tab');
        activeTab.classList.remove('border-transparent');
      }

      // Initialize with PIN tab active
      document.addEventListener('DOMContentLoaded', function() {
        switchTab('pin');
      });
    </script>
  </body>
</html>
