<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <link
      href="{{ asset('/main/login.css') }}"
      rel="stylesheet"
    />
        <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
</head>
  <body>

    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3 hidden md:block"></div>

    <div class="">
      <div class=""></div>
      <div
      class="bg-white rounded-xl shadow-xl p-8 w-[500px] z-20 text-center h-[500px] relative "
    >

      <div class="flex items-center justify-center pb-4">
        <img src="{{ Storage::url('common/octoverse-logo.png') }}" alt="" class="w-48">
      </div>


      <div class="mt-3  ">
        <h2 class="text-2xl font-semibold text-gray-700 text">
          Welcome To <span class="text-pink-600">Octoverse</span>!
        </h2>
        <p class="text-gray-700 text-md mt-2 " style="font-family: 'Libre Baskerville';">Login to get started.</p>
      </div>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mt-8 space-y-2">
        <input
        style="font-family: 'Libre Baskerville';"
          type="text"
          placeholder="Enter Your User ID"
          name="user_id"
          class="w-96 mt-1 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400 focus:border-transparent text-gray-700 placeholder-gray-500 text-sm"
        />
        <input
        style="font-family: 'Libre Baskerville';"
          type="password"
          name="password"
          placeholder="Enter Your Password"
          class="w-96 mt-1 px-3 py-3  border border-gray-500  rounded-2xl focus:outline-none focus:ring-2 focus:ring-puple-400 focus:border-transparent text-gray-700 placeholder-gray-500 text-sm"
        />
        <div class="">
            <button class="w-96 bg-purple-100 py-2 rounded-3xl text-lg text-gray-700 space-x-1" style="font-family: 'Libre Baskerville';background-color: #8FA5F499;"> LOGIN </button>
        </div>
      </div>
      </form>



      <div class="text-sm text-center mt-10 " style="font-family: 'Libre Baskerville';">
        <a href="{{ route('password.request') }}" class="text-gray-800 fw-semibold ">Forget Password?</a>
      </div>

    </div>
      <div class=""></div>
    </div>
  </body>
</html>
