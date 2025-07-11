@extends('welcome')
@section('main')
    <div class="relative overflow-hidden min-h-screen">
        <div class="absolute -left-[212px] -top-[402px] bg-[rgba(230,231,235,0.76)] rotate-[0.34deg] z-0"
         style="
         width: 1995px;
         height:1200px;
        border-bottom-left-radius: 850px;
        border-bottom-right-radius: 800px;
         ">
         </div>

        <div class="relative z-10">
            @include('layouts.frontnav')
        </div>

       <div class="">
         <section class="relative z-10 w-full py-12 md:py-24 flex flex-col md:flex-row items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Text -->
            <div class="max-w-xl flex justify-center w-full md:w-auto mb-10 md:mb-0">
               <div class="sm:ml-18 md:ml-12 lg:ml-24 xl:ml-48 text-center md:text-left">
                 <h3 class="text-pink-500 font-semibold tracking-widest mb-2 text-sm md:text-md text-left">SOLUTIONS</h3>
                <h1 class="text-left   text-4xl sm:text-5xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-[#2d2c3c] leading-tight mb-6 font-serif">
                    Ready
                    <br class="">
                     To Pay?
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-[#5c5b6a] leading-relaxed font-sans">
                    Pay for your items or services with ease using our secure payment link. No need to enter lengthy details here.
                </p>
               </div>
            </div>

           <div class="relative flex justify-center items-center w-full max-w-full sm:max-w-4xl">
                <!-- Background shape -->
                <img src="{{ Storage::url('common/phone-bg.png') }}"
                     class="absolute z-0 w-[300px] sm:w-[400px] md:w-[500px] lg:w-[600px] xl:w-[700px] h-auto top-7 right-[-50px] sm:right-[-80px] md:right-[-100px] rounded-l-full"
                     alt="">

                <!-- Phone & chats -->
                <div class="relative left-[50px] sm:left-[100px] md:left-[150px] lg:left-[200px] top-[-24px]">
                    <!-- Phone -->
                    <img src="{{ Storage::url('common/phone.png') }}"
                         class="relative z-10 drop-shadow-xl w-[150px] sm:w-[180px] md:w-[200px] lg:w-[240px] xl:w-[300px] -mt-30 mx-auto"
                         alt="Phone mockup">

                    <!-- Chat 1 -->
                    <div class="absolute flex items-center space-x-1 z-10 left-[-40px] sm:left-[-60px] md:left-[-70px] top-[20px] sm:top-[30px] md:top-[40px]">
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                             class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                        <span class="bg-purple-600 text-white px-2 py-1 rounded-full shadow text-[8px] sm:text-[10px]">You can pay me through this link</span>
                    </div>

                    <!-- Chat 2 -->
                    <div class="absolute flex items-center space-x-1 z-10 left-[-10px] sm:left-[-15px] md:left-[-20px] bottom-[40px] sm:bottom-[60px] md:bottom-[70px]">
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                             class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                        <span class="bg-purple-600 text-white px-2 py-1 rounded-full shadow text-[8px] sm:text-[10px]">Got it. Thanks</span>
                    </div>

                    <!-- Chat 3 -->
                    <div class="absolute top-1/3 right-[-10px] sm:right-[-15px] md:right-[-20px] flex items-center space-x-1 z-10">
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full shadow text-[8px] sm:text-[10px]">Payment sent!</span>
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                             class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                    </div>
                </div>
            </div>
        </section>
       </div>

        <div class="mt-10 md:mt-20 text-center px-4 sm:px-6 z-10 relative">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#3C425D] mb-4 md:mb-6 font-serif">What is Pay With Link?</h2>
            <p class="text-sm sm:text-base md:text-lg max-w-2xl mx-auto font-sans">
                "Pay with link" is a simple, secure web link for online payments, shared directly with customers for quick transactions without needing a website.
            </p>
        </div>

        <!-- Features Section -->
        <div class="py-10 md:py-16 px-4 sm:px-6 lg:px-8 mt-10 bg-[#F3F3F373]">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image -->
                <div class="flex justify-center order-2 md:order-1 mt-8 md:mt-0">
                    <div class="rounded-full p-2 sm:p-4 shadow-lg bg-gradient-to-br from-white via-pink-100 to-blue-200">
                        <img src="{{ Storage::url('common/pwl.png') }}" alt="Pay With Link" class="w-48 sm:w-64 md:w-72 lg:w-80">
                    </div>
                </div>
                <!-- Text Content -->
                <div class="order-1 md:order-2 text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-700 mb-4 md:mb-6 font-serif">New Payment Type is in Town!</h2>
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 mb-4 md:mb-6 font-sans">
                        Our company MPSS has a new payment type that's easy to use for merchants and user-friendly for customers. It's called PayWith Link. You can create payment links in just 3 easy steps:
                    </p>
                    <ol class="space-y-3 md:space-y-4 text-gray-700 list-decimal list-inside font-sans text-left mx-auto md:mx-0 max-w-md md:max-w-none">
                        <li class="flex items-start space-x-2">
                            <img src="{{ Storage::url('common/person.png') }}" class="w-5 md:w-6" alt="">
                            <span class="text-sm md:text-base">Get a merchant account with us</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <img src="{{ Storage::url('common/card.png') }}" class="w-5 md:w-6" alt="">
                            <span class="text-sm md:text-base">Create a payment link for your customers</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <img src="{{ Storage::url('common/share.png') }}" class="w-4 md:w-5" alt="">
                            <span class="text-sm md:text-base">Share the link via Email, SMS, or social media</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- What We Offer Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 md:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-700 mb-4 font-serif text-center md:text-center">What We Offer</h2>
                    <p class="text-sm sm:text-base md:text-lg px-16 text-gray-600 font-sans">
                        Our comprehensive payment solutions are designed to streamline your business operations. From seamless transactions to powerful analytics, we provide everything you need to manage payments efficiently and securely.
                    </p>
                </div>
                <div class="flex justify-center mt-6 md:mt-0">
                    <img src="{{ Storage::url('common/sc.jpg') }}" alt="PayWith Link Illustration" class="w-48 sm:w-56 md:w-64 lg:w-72 xl:w-80">
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="py-8 sm:py-12 bg-white mt-10 md:mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Feature Items -->
                    @php
                        $features = [
                            ['icon' => 'p.png', 'title' => 'All-in-one Payment Solution', 'desc' => 'Accept 20+ local and international digital payments through a single platform.'],
                            ['icon' => 't.png', 'title' => 'User Friendly', 'desc' => 'Easy to use for both merchants and customers, with no complicated forms.'],
                            ['icon' => 'c.png', 'title' => 'Secured Payments', 'desc' => 'Bank-level security to keep sensitive financial information safe.'],
                            ['icon' => 'd.png', 'title' => 'Dashboard', 'desc' => 'Analyze sales and revenue data efficiently in one centralized location.'],
                            ['icon' => 'l.png', 'title' => 'Transaction Validation', 'desc' => 'Monitor real-time transactions anytime, anywhere.'],
                            ['icon' => 's.png', 'title' => 'Settlement', 'desc' => 'Fast, reliable settlements with complete transparency.'],
                        ];
                    @endphp

                    @foreach($features as $feature)
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                            <img src="{{ Storage::url('common/' . $feature['icon']) }}" alt="{{ $feature['title'] }}" class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto mb-3 sm:mb-4">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
