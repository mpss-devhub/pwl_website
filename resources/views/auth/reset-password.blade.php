<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
   <link rel="stylesheet" href="{{ asset('common/main/css/login.css') }}">
    <script src="{{ asset('common/main/js/loading.js') }}"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100" style="font-family: 'Libre Baskerville', serif;">
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3 hidden md:block"></div>
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-[500px] text-center">

        <!-- Logo -->
        <div class="flex items-center justify-center pb-5">
            <a href="{{ route('main.home') }}">
                <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="" class="w-48">
                </a>
        </div>

        <!-- Header -->
        <p class="text-md font-semibold text-gray-700">Reset Password</p>
        <p class="text-gray-600 text-xs mt-2">Enter your email and new password.</p>

        <!-- Form -->
        <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}" required autofocus
                    placeholder="Enter Your Email"
                    class="w-96 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400  text-gray-700 placeholder-gray-500 text-xs" />
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <input type="password" name="password" required placeholder="Enter New Password"
                    class="w-96 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400  text-gray-700 placeholder-gray-500 text-xs" />
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <input type="password" name="password_confirmation" required placeholder="Confirm Password"
                    class="w-96 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400  text-gray-700 placeholder-gray-500 text-xs" />
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button id="submitBtn" type="submit" class="w-96 bg-purple-100 py-2 rounded-3xl text-md text-gray-700"
                    style="font-family: 'Libre Baskerville'; background-color: #8FA5F499;">
                   <span class="text"> Reset Password</span>
                    <span class="spinner" style="display:none;">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                </button>
            </div>
        </form>

        <!-- Back to Login -->
        <div class="text-xs text-center mt-6">
            <a href="{{ route('login') }}" class="text-gray-800 hover:underline">Back to Login</a>
        </div>
    </div>
</body>

</html>
