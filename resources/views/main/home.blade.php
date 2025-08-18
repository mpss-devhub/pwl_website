@extends('welcome')
@section('main')
    @include('components.background')

    <div class="">
        <section
            class="relative z-10 w-full py-12 md:py-24 flex flex-col md:flex-row items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Text content -->
            <div class="max-w-xl flex justify-center w-full md:w-auto mb-10 md:mb-0">
                <div class="sm:ml-18 md:ml-12 lg:ml-24 xl:ml-48 text-center md:text-left">
                    <h3 class="text-pink-500 font-semibold tracking-widest mb-2 text-sm md:text-md text-left
                           scroll-animate fade-in"
                        data-delay="0.1">SOLUTIONS</h3>
                    <h1 class="text-left  text-4xl sm:text-5xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-[#2d2c3c] leading-tight mb-6 font-serif
                           scroll-animate fade-in"
                        data-delay="0.2">
                        Ready
                        <br class="">
                        To Pay?
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-[#5c5b6a] leading-relaxed font-sans
                          scroll-animate fade-in"
                        data-delay="0.3">
                        Pay for your items or services with ease using our secure payment link. No need to enter lengthy
                        details here.
                    </p>
                </div>
            </div>

            <div class="relative flex justify-center items-center w-full max-w-full sm:max-w-4xl">
                <!-- Background shape (always pulsing) -->
                <img src="{{ Storage::url('common/phone-bg.png') }}"
                    class="absolute z-0 w-[300px] sm:w-[400px] md:w-[500px] lg:w-[600px] xl:w-[700px] h-auto top-7 right-[-50px] sm:right-[-80px] md:right-[-100px] rounded-l-full
                            animate-[pulse_5s_ease-in-out_infinite]"
                    alt="">

                <!-- Phone & chats -->
                <div
                    class="relative left-[90px] top-[-24px] sm:left-[220px] sm:top-[-5px] md:left-[100px] lg:left-[110px] xl:left-[120px] 2xl:left-[170px]">
                    <!-- Phone (always bouncing) -->
                  <img src="{{ Storage::url('common/phone.png') }}"
     class="relative z-10 drop-shadow-xl w-[140px] sm:w-[170px] md:w-[180px] lg:w-[240px] xl:w-[300px] -mt-30 mx-auto
            animate-gentle-bounce"
     alt="Phone mockup">

                    <!-- Chat 1 -->
                    <div class="absolute flex items-center space-x-1 z-10 left-[-50px] sm:left-[-60px] md:left-[-70px] top-[20px] sm:top-[30px] md:top-[40px]
                               scroll-animate slide-left"
                        data-delay="0.3">
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                            class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                        <span
                            class="bg-purple-600 text-white px-2 py-1 rounded-full shadow text-[7px] sm:text-[8px] md:text-[9px] lg:text-[11px]">You
                            can pay me through this link</span>
                    </div>

                    <!-- Chat 2 -->
                    <div class="absolute flex items-center space-x-1 z-10 left-[-30px] sm:left-[-15px] md:left-[-20px] bottom-[40px] sm:bottom-[60px] md:bottom-[70px]
                               scroll-animate slide-left"
                        data-delay="0.5">
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                            class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                        <span
                            class="bg-purple-600 text-white px-2 py-1 rounded-full shadow text-[7px] sm:text-[8px] md:text-[9px] lg:text-[11px]">Got
                            it. Thanks</span>
                    </div>

                    <!-- Chat 3 -->
                    <div class="absolute top-1/3 right-[-30px] sm:right-[-15px] md:right-[-20px] flex items-center space-x-1 z-10
                               scroll-animate slide-right"
                        data-delay="0.7">
                        <span
                            class="bg-green-500 text-white px-2 py-1 rounded-full shadow text-[7px] sm:text-[8px] md:text-[9px] lg:text-[11px]">Payment
                            sent!</span>
                        <img src="{{ Storage::url('common/demo.png') }}" alt="User"
                            class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border-2 border-white shadow-md">
                    </div>
                </div>
            </div>
        </section>
        <!-- Section with scroll animation -->
        <div class="mt-10 md:mt-20 text-center px-4 sm:px-6 z-10 relative
                   scroll-animate fade-in"
            data-delay="0.5">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#3C425D] mb-4 md:mb-6 font-serif">What is Pay With
                Link?</h2>
            <p class="text-sm sm:text-base md:text-lg max-w-2xl mx-auto font-sans">
                "Pay with link" is a simple, secure web link for online payments, shared directly with customers for quick
                transactions without needing a website.
            </p>
        </div>

        <!-- Features section with scroll animations -->
        <div class="py-10 md:py-16 px-4 sm:px-6 lg:px-8 mt-10 bg-[#F3F3F373]">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Image -->
                <div
                    class="flex justify-center order-2 md:order-1 mt-8 md:mt-0
                          scroll-animate float-slow">
                    <div
                        class="rounded-full p-2 sm:p-4 shadow-lg bg-gradient-to-br from-white via-pink-100 to-blue-200
                               hover:shadow-xl transition-all duration-300">
                        <img src="{{ Storage::url('common/z2.png') }}" alt="Pay With Link"
                            class="w-48 sm:w-64 md:w-72 lg:w-80 hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
                <!-- Text content -->
                <div class="order-1 md:order-2 text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-700 mb-4 md:mb-6 font-serif
                              scroll-animate fade-in"
                        data-delay="0.2">New Payment Type is in Town!</h2>
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 mb-4 md:mb-6 font-sans
                              scroll-animate fade-in"
                        data-delay="0.3">
                        Our company MPSS has a new payment type that's easy to use for merchants and user-friendly for
                        customers. It's called PayWith Link. You can create payment links in just 3 easy steps:
                    </p>
                    <ol
                        class="space-y-3 md:space-y-4 text-gray-700 list-decimal list-inside font-sans text-left mx-auto md:mx-0 max-w-md md:max-w-none">
                        <li class="flex items-start space-x-2
                                  scroll-animate fade-right"
                            data-delay="0.4">
                            <img src="{{ Storage::url('common/person.png') }}" class="w-5 md:w-6" alt="">
                            <span class="text-sm md:text-base">Get a merchant account with us</span>
                        </li>
                        <li class="flex items-start space-x-2
                                  scroll-animate fade-right"
                            data-delay="0.5">
                            <img src="{{ Storage::url('common/card.png') }}" class="w-5 md:w-6" alt="">
                            <span class="text-sm md:text-base">Create a payment link for your customers</span>
                        </li>
                        <li class="flex items-start space-x-2
                                  scroll-animate fade-right"
                            data-delay="0.6">
                            <img src="{{ Storage::url('common/share.png') }}" class="w-4 md:w-5" alt="">
                            <span class="text-sm md:text-base">Share the link via Email, SMS, or social media</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- What We Offer section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 md:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-700 mb-4 font-serif text-center md:text-center
                              scroll-animate fade-in"
                        data-delay="0.2">What We Offer</h2>
                    <p class="text-sm sm:text-base md:text-lg px-16 text-gray-600 font-sans
                              scroll-animate fade-in"
                        data-delay="0.3">
                        Our comprehensive payment solutions are designed to streamline your business operations. From
                        seamless transactions to powerful analytics, we provide everything you need to manage payments
                        efficiently and securely.
                    </p>
                </div>
                <div class="flex justify-center mt-6 md:mt-0">
                    <img src="{{ Storage::url('common/sc.jpg') }}" alt="PayWith Link Illustration"
                        class="w-48 sm:w-56 md:w-64 lg:w-72 xl:w-80
                                scroll-animate pulse-slow hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </div>

        <!-- Features grid with scroll animations -->
        <div class="py-8 sm:py-12 bg-white mt-10 md:mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @php
                        $features = [
                            [
                                'icon' => 'p.png',
                                'title' => 'All-in-one Payment Solution',
                                'desc' =>
                                    'Accept 20+ local and international digital payments through a single platform.',
                            ],
                            [
                                'icon' => 't.png',
                                'title' => 'User Friendly',
                                'desc' => 'Easy to use for both merchants and customers, with no complicated forms.',
                            ],
                            [
                                'icon' => 'c.png',
                                'title' => 'Secured Payments',
                                'desc' => 'Bank-level security to keep sensitive financial information safe.',
                            ],
                            [
                                'icon' => 'd.png',
                                'title' => 'Dashboard',
                                'desc' => 'Analyze sales and revenue data efficiently in one centralized location.',
                            ],
                            [
                                'icon' => 'l.png',
                                'title' => 'Transaction Validation',
                                'desc' => 'Monitor real-time transactions anytime, anywhere.',
                            ],
                            [
                                'icon' => 's.png',
                                'title' => 'Settlement',
                                'desc' => 'Fast, reliable settlements with complete transparency.',
                            ],
                        ];
                    @endphp

                    @foreach ($features as $index => $feature)
                        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg text-center hover:shadow-md transition-all duration-300 transform hover:-translate-y-1
                                    scroll-animate fade-up"
                            data-delay="{{ ($index % 3) * 0.1 }}">
                            <img src="{{ Storage::url('common/' . $feature['icon']) }}" alt="{{ $feature['title'] }}"
                                class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 mx-auto mb-3 sm:mb-4 hover:scale-110 transition-transform duration-300">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">
                                {{ $feature['title'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
