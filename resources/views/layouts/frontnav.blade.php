<nav class="bg-white/80 backdrop-blur-md md:bg-transparent md:backdrop-blur-0 shadow md:shadow-none rounded-b-lg md:rounded-none">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      <!-- Logo -->
      <a href="{{ route('main.home') }}" class="flex items-center">
        <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-20 sm:w-28 h-auto" alt="Octoverse Logo">
      </a>

      <!-- Mobile menu button -->
      <div class="md:hidden">
        <button type="button" class="text-gray-700 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-md"
                aria-controls="mobile-menu" aria-expanded="false" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-6 font-medium">
        <a href="{{ route('main.home') }}" class="text-gray-700 hover:text-purple-500">HOME</a>
        <a href="{{ route('main.aboutus') }}" class="text-gray-700 hover:text-purple-500">ABOUT US</a>
        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-500">LOGIN</a>
        <a href="{{ route('main.contactus') }}" class="text-gray-700 hover:text-purple-500">CONTACT US</a>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="md:hidden hidden px-4 pt-2 pb-3 space-y-1 bg-white/90 backdrop-blur-md rounded-b-lg shadow" id="mobile-menu">
    <a href="{{ route('main.home') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-purple-100 hover:text-purple-600">HOME</a>
    <a href="{{ route('main.aboutus') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-purple-100 hover:text-purple-600">ABOUT US</a>
    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-purple-100 hover:text-purple-600">LOGIN</a>
    <a href="{{ route('main.contactus') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-purple-100 hover:text-purple-600">CONTACT US</a>
  </div>
</nav>
