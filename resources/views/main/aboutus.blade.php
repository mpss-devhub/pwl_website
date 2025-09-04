@extends('welcome')
@section('main')
    <div class="z-10 relative py-12 min-h-screen px-4 sm:px-6 lg:px-8 text-[#5c5b6a]"
        style="font-family: 'Poppins', sans-serif;">

        <div class="py-6 mx-auto max-w-6xl">
            <div
                class="text-left text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-[#2d2c3c]
                           scroll-animate fade-in font-semibold">
                <p>Accept Payment</p>
                <p class="mt-2">Anytime, Anywhere</p>
            </div>
            <p class="mt-4 text-left leading-relaxed">
                Access to variety of digital payment methods in a single platform. Simplify financial
                transactions for your sustainable business growth. A fast and secure way to accept payments into your
                pocket.
            </p>
        </div>

        <hr class="my-6 mx-auto max-w-4xl border-2 border-gray-300">

        <div class="flex flex-col items-center justify-center py-10 mx-auto max-w-5xl text-center px-4">
            <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl font-semibold text-[#2d2c3c]">OUR COMPANY JOURNEY</p>
            <p class="mt-8 leading-relaxed">
                Myanmar Payment Solution Services Company Limited (MPSS) is a
                trailblazing financial technology company established in 2014. Understanding there are areas where we see
                our expertise and solutions having even bigger potential, we are bringing in FinTech solutions to expand the
                financial industry and create more business opportunities in a way that vastly benefits society with a new
                enhanced approach as a FinTech enabler, <b>“Octoverse”</b>, starting from the year 2022 - 2023.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-evenly py-10 gap-8 lg:gap-12 mx-auto max-w-6xl">
            <img src="{{ Storage::url('common/abt.png') }}" alt="" class="w-3/4 sm:w-2/3 md:w-1/2 lg:w-1/3">
            <div class="text-center">
                <p class="text-xl font-semibold text-[#2d2c3c]">All Your Payment, One Link</p>
                <p class="px-4 mt-4">
                    Pay easily with your favorite method- <br>
                    anywhere, anytime
                </p>
            </div>
        </div>

        <div class="text-center py-4 px-4">
            <p>We bring together the most popular payment methods in one place.</p>
        </div>

    </div>
@endsection
