@extends('welcome')
@section('main')
@include('components.background')

<div class="z-10" style="font-family: 'Poppins', sans-serif;">
    <div class="mx-auto max-w-7xl relative px-4 sm:px-6 lg:px-8 text-[#2d2c3c]">
        <div class="py-4 mx-auto">
            <p class="text-sm sm:text-md md:text-xl lg:text-2xl xl:text-2xl font-semibold text-center p-6">
                Contact Us
            </p>
            <div class="flex flex-col lg:flex-row gap-8 items-center overflow-hidden p-4">

                <div class="w-full lg:w-1/2">
                    <div class="space-y-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">
                            We are here to help you
                        </h2>
                        <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                            If you have any questions or need assistance, feel free to reach out to us.
                            We are committed to providing you with the best support possible.
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 flex justify-center">
                    <img src="{{ Storage::url('common/mict.png') }}"
                        class="rounded-lg object-cover w-full sm:w-4/5 lg:w-full h-auto max-h-80 shadow-sm"
                        alt="MICT Park Building" loading="lazy">
                </div>
            </div>
        </div>
    </div>
    <div class="relative flex flex-col lg:flex-row bg-[#3C425D] text-white">
        <div class="flex-1 flex justify-center items-center p-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1909.2558630638473!2d96.12817513854186!3d16.85056209598697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194ec85f1889f%3A0xb474329393659558!2sMyanmar%20Payment%20Solution%20Services%20Co.%2C%20Ltd.!5e0!3m2!1smy!2smm!4v1755227441830!5m2!1smy!2smm"
                class="rounded-lg shadow-lg w-full h-64 sm:h-80 md:h-96 lg:h-[300px]"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="flex-1 space-y-6 p-6 sm:p-8">
            <p class="text-base sm:text-lg leading-3 text-start">STAY IN THE KNOW</p>
            <div class="flex items-center gap-2 text-sm sm:text-base">
                <i class="fa-solid fa-location-dot text-gray-200"></i>
                <span>Building 9, 1st Floor, MICT Park, Hlaing Township, Yangon, Myanmar</span>
            </div>
            <div class="flex items-center gap-2 text-sm sm:text-base">
                <i class="fa-solid fa-phone text-gray-200"></i>
                <span>+95 9882551251 , 252, 253</span>
            </div>
            <div class="flex items-center gap-2 text-sm sm:text-base">
                <i class="fa-solid fa-envelope text-gray-200"></i>
                <span>office@octoverse.asia</span>
            </div>
            <div class="flex items-center gap-2 text-sm sm:text-base">
                <i class="fa-solid fa-clock text-gray-200"></i>
                <span>Mon-Fri: 8:30AM To 4:30PM</span>
            </div>
            <div>
                <span class="block text-center sm:text-start p-2">Have Any Questions ?</span>
                <hr class="border-gray-300 mt-2">
                <div class="flex justify-center sm:justify-start gap-4 p-4 text-2xl">
                    <i class="fa-brands fa-facebook text-gray-200"></i>
                    <i class="fa-brands fa-facebook-messenger text-gray-200"></i>
                    <i class="fa-brands fa-instagram text-gray-200"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
