<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('/main/login.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3 hidden md:block"></div>
    <div class="">
        <div class=""></div>
        <div class="bg-white rounded-xl shadow-xl p-8 w-[500px] z-20 text-center h-[500px] relative ">
            <div class="flex items-center justify-center pb-4">
                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="" class="w-48">
            </div>
            <div class="mt-3">
                <h2 class="text-2xl font-semibold text-gray-700 text">
                    Welcome To <span class="text-pink-600">Octoverse</span>!
                </h2>
                <p class="text-gray-700 text-md mt-2 " style="font-family: 'Libre Baskerville';">Login to get started.
                </p>
            </div>
            <form action="{{ route('check') }}" method="POST">
                @csrf
                <div class="mt-8">
                    <input style="font-family: 'Libre Baskerville';" type="email" placeholder="Enter your Email"
                        name="email"
                        class="w-96 mt-1 px-3 py-3  border border-gray-500 shadow-lg rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400 focus:border-transparent text-gray-700 placeholder-gray-500 text-sm" />
                </div>
            </form>

            @if (session('error'))
                <div class="border mt-4 py-2 px-5 mx-8 rounded-2xl">

                    <div class="flex">
                        <div class="">
                            <i class="fa-solid fa-circle-xmark text-red-500 text-lg mx-1"></i>
                        </div>

                        <div class=" text-xs mx-1   text-red-600">
                            {{ session('error') }}
                            <a href=""> Connect Now !</a>
                        </div>
                    </div>

                </div>
            @else
                     <div class="border mt-4 py-2 px-5 mx-8 rounded-2xl">

                    <div class="flex">
                        <div class="">
                            <i class="fa-solid fa-user-check text-pink-500 text-md mx-1"></i>


                        </div>

                        <div class=" text-xs mx-1   text-gray-600 mt-1" >
                           Click Enter To Check Your Account is Exist or Not !

                        </div>
                    </div>

                </div>

            @endif
            <div class="text-sm text-center mt-20 " style="font-family: 'Libre Baskerville';">
                <a href="#" class="text-gray-800 fw-semibold ">Forget Password?</a>
            </div>
        </div>
        <div class=""></div>
    </div>
</body>

</html>
