@extends('welcome')
@section('main')

    <div class="z-10 mx-20 relative py-12  min-h-screen  px-4 sm:px-6 lg:px-8 text-[#2d2c3c]"
        style="font-family: 'Poppins', sans-serif;">
        <div class="py-6 mx-20 ">
            <div
                class="text-left text-sm sm:text-sm md:text-md lg:text-xl xl:text-2xl
                           scroll-animate fade-in font-semibold">
                <p class="">
                    Accept Payment
                </p>
                <p class="mt-2">Anytime, Anywhere</p>
            </div>
            <p class="mt-4  text-left flex justify-start">
                Access to variety of digital payment methods in a single platform. Simplify financial
                transactions for your
                <br>
                sustainable business growth. A fast and secure way to accept payments into your pocket.
            </p>
        </div>
        <hr class="my-3 mx-40 border-2 border-gray-300">


        <div class="flex flex-col items-center justify-center py-10  mx-20">
            <p class="text-sm sm:text-sm md:text-md lg:text-xl xl:text-2xl font-semibold">OUR COMPANY JOURNEY</p>
            <p class="mt-8 leading-relaxed text-center">Myanmar Payment Solution Services Company Limited (MPSS) is a
                trailblazing financial technology company
                Myanmar Payment Solution Services Company Limited (MPSS) is a trailblazing financial technology company
                established in 2014. Understanding there are areas where we see our expertise and solutions having even
                bigger potential, we are bringing in FinTech solutions to expand the financial industry and create more
                business opportunities in a way that vastly benefits society with a new enhanced approach as a FinTech
                enabler, “Octoverse”, starting from the year 2022 - 2023.</p>
        </div>
        <div class="flex items-center justify-evenly py-6">

            <img src="{{ Storage::url('common/abt.png') }}" alt="" width="30%">
            <div class="">
                <p class="text-center text-xl font-semibold">All Your Payment, One Link</p>
                <p class="px-4 text-center mt-4">Pay easily with your favorite method-
                    <br>
                    anywhere, anytime
                </p>
            </div>
        </div>

        <div class="text-center py-2 ">
            <p>We bring together the most popular payment methods in one place.</p>
        </div>

    </div>
@endsection
