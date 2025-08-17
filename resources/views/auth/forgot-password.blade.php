<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('common/main/css/login.css') }}">
    <script src="{{ asset('common/main/js/loading.js') }}"></script>
</head>

<body>
    <!-- Background shapes -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3 hidden md:block"></div>

    <div class="">
        <div class=""></div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-xl p-8 w-[500px] z-20 text-center h-auto relative">
            <!-- Logo -->
            <div class="flex items-center justify-center pb-4">
                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="Logo" class="w-48">
            </div>

            <!-- Heading -->
            <div class="mt-3">
                <h2 class="text-md font-semibold text-gray-700">
                    Forgot your <span class="text-pink-600">Password</span>?
                </h2>
                <p class="text-gray-700 text-sm mt-2" style="font-family: 'Libre Baskerville';">
                    Enter your email and we’ll send you a reset link.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div class="text-xs text-green-600 mt-4">
                    {{ session('status') }}
                </div>
            @endif

            @error('email')
                <div class="text-xs text-red-600 mt-4">{{ $message }}</div>
            @enderror

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="mt-3 space-y-4">
                @csrf

                <!-- Email input -->
                <input style="font-family: 'Libre Baskerville';" type="email" name="email"
                    placeholder="Enter Your Email" value="{{ old('email') }}" required autofocus
                    class="w-96 mt-1 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400 focus:border-transparent text-gray-700 placeholder-gray-500 text-sm" />

                <!-- Submit -->
                <button id="submitBtn" class="w-96 bg-purple-100 py-2 rounded-3xl text-lg text-gray-700"
                    style="font-family: 'Libre Baskerville'; background-color: #8FA5F499;">
                    <span class="text"> Send Reset Link</span>
                    <span class="spinner" style="display:none;">
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>
            </form>

            <!-- Back to login -->
            <div class="text-sm text-center mt-10" style="font-family: 'Libre Baskerville';">
                <a href="{{ route('login') }}" class="text-gray-800">← Back to Login</a>
            </div>
        </div>

        <div class=""></div>
    </div>
</body>

</html>
