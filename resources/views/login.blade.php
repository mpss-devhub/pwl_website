<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ Storage::url('common/icon.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/main/css/login.css') }}">
    <script src="{{ asset('common/main/js/loading.js') }}"></script>
</head>

<body>

    <div class="bg-shape bg-shape-1 slide-left"></div>
    <div class="bg-shape bg-shape-2 slide-left"></div>
    <div class="bg-shape bg-shape-3 hidden md:block slide-right"></div>

    <div class="flex items-center justify-center min-h-screen">
        @include('layouts.alert')
        <div class=""></div>

        <div
            class="bg-white rounded-xl shadow-xl w-full max-w-[500px] z-20 text-center h-auto relative
            p-6 sm:p-12 mx-4 sm:mx-auto">
            <div class="flex items-center justify-center pb-4">
                <a href="{{ route('main.home') }}">
                    <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt=""
                        class="w-32 sm:w-48 max-w-full h-auto">
                </a>
            </div>

            <div class="mt-1">
                <p class="text-md sm:text-xl font-semibold text-gray-700 text">
                    Welcome To <span class="text-pink-600">Octoverse</span>
                </p>
                <p class="text-sm sm:text-md text-gray-700 mt-2" style="font-family: 'Libre Baskerville';">
                    Login to get started.
                </p>

            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mt-5 space-y-3">
                    <input style="font-family: 'Libre Baskerville';" type="text" placeholder="Enter Your User ID"
                        name="user_id" value="{{ old('user_id') }}"
                        class="w-full mt-1 px-3 py-3 border border-gray-500 rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400     text-gray-700 placeholder-gray-500 text-sm" />

                    <input style="font-family: 'Libre Baskerville';" type="password" name="password"
                        placeholder="Enter Your Password"
                        class="w-full mt-1 px-3 py-3 border border-gray-500 rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400     text-gray-700 placeholder-gray-500 text-sm" />

                    <div class="w-full flex justify-between my-4">

                        <div class="mx-5">
                            <div class=""></div>
                            <div class="mx-5">
                                <div class="flex items-center justify-center space-x-4">
                                    <button type="button"
                                        onclick="document.getElementById('captcha-img').src='{{ captcha_src('flat') }}?'+Math.random()">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                    <img id="captcha-img" src="{{ captcha_src('flat') }}" alt="captcha"
                                        class="w-32 h-12 rounded">
                                </div>
                            </div>
                            <div class=""></div>
                        </div>
                        <div class="">
                            <input type="text" name="captcha" placeholder="Enter Captcha"
                                style="font-family: 'Libre Baskerville';"
                                class="w-full mt-1 px-3 py-3 border border-gray-500 rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400 text-gray-700 placeholder-gray-500 text-sm" />

                        </div>
                    </div>
                    @error('captcha')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div>
                        <button id="submitBtn"
                            class="w-full bg-purple-100 py-2 sm:py-3 rounded-3xl text-base sm:text-lg text-gray-700 flex items-center justify-center space-x-2"
                            style="font-family: 'Libre Baskerville'; background-color: #8FA5F499;">
                            <span class="text">LOGIN</span>
                            <span class="spinner hidden">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </div>

                </div>

            </form>

            <div class="text-sm text-center mt-6" style="font-family: 'Libre Baskerville';">
                <a href="{{ route('password.request') }}" class="text-gray-800 fw-semibold">Forget Password?</a>
            </div>
        </div>

        <div class=""></div>
    </div>

</body>

</html>
