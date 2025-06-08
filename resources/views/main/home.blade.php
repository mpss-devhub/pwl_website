@extends('welcome')
@section('main')
    <div class="py-12">
        <!-- First Section -->
        <section class="px-6 md:px-16 py-16 flex flex-col md:flex-row items-center justify-around">
            <div class="max-w-xl">
                <h3 class="text-pink-500 font-semibold tracking-widest mb-2">SOLUTIONS</h3>
                <h1 class="text-5xl md:text-7xl font-bold text-[#2d2c3c] leading-tight mb-6" style="font-family:'Libre Baskerville' ">Ready <br> To Pay?</h1>
                <p class="text-[#5c5b6a] text-xl leading-relaxed" style="font-family:'Poppins">Pay For Your Items Or Services With Ease Using Our Secure
                    Payment Link. No Need To Enter Lengthy Details Here.</p>
            </div>

            <div class="relative mt-10 md:mt-0 flex justify-center items-center">
                <div class="absolute w-[550px] h-[550px] -top-20 -right-20 bg-blue-100 rounded-full z-0"></div>
               <div class="">
                 <img src="{{ Storage::url('/common/image.png') }}"
                    class="relative w-[300px] z-10 drop-shadow-xl -left-12">
                <div class="absolute -left-[180px] top-9 flex items-center space-x-2 z-10">
                    <img src="{{ Storage::url('/common/image copy.png') }}" alt="User 1"
                        class="w-8 h-8 rounded-full border-2 border-white shadow-md">
                    <span class="bg-purple-600 text-white text-xs px-4 py-1 rounded-full shadow">You can pay me through this
                        link</span>
                </div>
                <div class="absolute -left-[100px] bottom-12 flex items-center space-x-2 z-10">
                    <img src="{{ Storage::url('/common/image copy.png') }}" alt="User 1"
                        class="w-8 h-8 rounded-full border-2 border-white shadow-md">
                    <span class="bg-purple-600 text-white text-xs px-4 py-1 rounded-full shadow">Got it. Thanks</span>
                </div>
                <div class="absolute -right-[20px] top-1/3 flex items-center space-x-2 z-10">
                    <span class="bg-green-500 text-white text-xs px-4 py-1 rounded-full shadow">Payment sent!</span>
                    <img src="{{ Storage::url('/common/image copy.png') }}" alt="User 2"
                        class="w-8 h-8 rounded-full border-2 border-white shadow-md">
                </div>
               </div>
            </div>
        </section>
        <!-- Secound Section -->
        <div class="mt-20">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6 mt-12" style="font-family: Libre Baskerville;">
                What is Pay With Link?
            </h2>
            <p class="text-center" style="font: Poppins;">Pay with link" is a simple, secure web link for online payments,
                shared directly with customers for quick transactions without needing a website.
            </p>
        </div>
        <!--Third section-->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image -->
                <div class="flex justify-center">

                     <div class="bg-pink-200 shadow-lg " style="border-radius: 200px">
                        <img src="{{ Storage::url('common/pwl.png') }}" alt="Pay With Link" class="w-80">
                    </div>

                </div>

                <!-- Text Content -->
                <div class="order-2 md:order-1">
                    <h2 class="text-6xl md:text-4xl font-bold text-gray-700 mb-6" style="font-family: Libre Baskerville;">
                        New Payment Type is in Town!
                    </h2>
                    <p class="text-lg text-muted  text-gray-600 mb-6" style="font-family:'Poppins' ">
                        Our Company MPSS Has A New Payment Type That Is Easy To Use For Merchants And User-Friendly For
                        Customers. It's Called PayWith Link. You Can Create Payment Links In
                         <br>
                         Just 3 Easy Steps:
                    </p>
                    <ol class="space-y-4 text-gray-700 font-medium" style="font: Poppins;">
                        <li class="flex items-start">
                            <span
                                class="bg-blue-100 text-blue-800 font-bold rounded-full h-8 w-8 flex items-center justify-center mr-3">1</span>
                            <span>Get A Merchant Account With Us</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-blue-100 text-blue-800 font-bold rounded-full h-8 w-8 flex items-center justify-center mr-3">2</span>
                            <span>Create A Payment Link For Your Customers</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-blue-100 text-blue-800 font-bold rounded-full h-8 w-8 flex items-center justify-center mr-3">3</span>
                            <span>Share The Link Via Email, SMS, Or Social Media</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!--Fourth Section-->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-center ">
                    <h2 class="text-4xl font-bold text-gray-700 mb-4" style="font-family: Libre Baskerville;">
                        What We Offer
                    </h2>
                    <p class="text-gray-600 max-w-3xl mx-auto text-xl" style="font-family: 'Poppins">
                        Our comprehensive payment solutions are
                        <br>
                        designed to streamline your business operations.
                        <br>
                        From seamless transactions to powerful analytics,
                        <br>
                         we provide everything you need to manage
                         <br>
                         payments efficiently and securely.
                    </p>
                </div>
                <div class="order-1 md:order-2 flex justify-center">
                    <img src="{{ Storage::url('common/sc.jpg') }}" alt="PayWith Link Illustration"
                        class="w-72">
                </div>
            </div>
        </div>
        <!--Fiveth Section-->
        <div class="py-12 bg-white mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Features Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/p.png') }}" alt="Payment Solution"
                            class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">All-in-one Payment Solution</h3>
                        <p class="text-sm text-gray-600">
                            Accept 20+ local and international digital payments through a single platform.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/t.png') }}" alt="Flexible Integration"
                            class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">User Friendly</h3>
                        <p class="text-sm text-gray-600">
                            Easy to use for both merchants and customers, with no complicated forms.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/c.png') }}" alt="Secured Payments"
                            class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Secured Payments</h3>
                        <p class="text-sm text-gray-600">
                            Bank-level security to keep sensitive financial information safe.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/d.png') }}" alt="Dashboard" class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Dashboard</h3>
                        <p class="text-sm text-gray-600">
                            Analyze sales and revenue data efficiently in one centralized location.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/l.png') }}" alt="Transaction Validation"
                            class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Transaction Validation</h3>
                        <p class="text-sm text-gray-600">
                            Monitor real-time transactions anytime, anywhere.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                        <img src="{{ Storage::url('common/s.png') }}" alt="Settlement" class="w-16 h-16 mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Settlement</h3>
                        <p class="text-sm text-gray-600">
                            Fast, reliable settlements with complete transparency.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
