<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ Storage::url('common/octoverse-logo.png') }}" class="w-18 h-10 ml-2 dark:hidden"
                        alt="Octoverse Logo (Light Mode)" />

                    <img src="{{ Storage::url('common/o2.png') }}" class="w-18 h-10 ml-2 hidden dark:block"
                        alt="Octoverse Logo (Dark Mode)" />
                </a>



            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 mr-4"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ Storage::url('common/undraw_profile.svg') }}"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">
                                    {{ Auth::user()->permission->user_group }} Dept
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('forgotpassword') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Change Password</a>
                            </li>
                            <li>
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left">Sign out</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<aside id="logo-sidebar"
    class="fixed top-0 px-1 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 rounded-lg group
                  {{ request()->routeIs('admin.dashboard')
                      ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 transition duration-75
                        {{ request()->routeIs('admin.dashboard')
                            ? 'text-gray-900 dark:text-white'
                            : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            {{-- Transactions --}}
            @if (in_array('T', $per))
                <li>
                    <a href="{{ route('tnx.show') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('tnx.show', 'admin.tnx.detail', 'admin.Payment.detail')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75
                            {{ request()->routeIs('tnx.show', 'admin.tnx.detail', 'admin.Payment.detail')
                                ? 'text-gray-900 dark:text-white'
                                : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998
                         8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0
                         11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51
                         8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="flex-1 ms-3">Transaction</span>
                    </a>
                </li>
            @endif

            {{-- Links History --}}
            @if (in_array('L', $per))
                <li>
                    <a href="{{ route('admin.links') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('admin.links', 'admin.sms.details', 'admin.link.edit')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i
                            class="fa-solid fa-shield-halved
                          {{ request()->routeIs('admin.links', 'admin.sms.details', 'admin.link.edit')
                              ? 'text-gray-900 dark:text-white'
                              : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        </i>
                        <span class="flex-1 ms-3">Links History</span>
                    </a>
                </li>
            @endif

            {{-- Settlement --}}
            @if (in_array('S', $per))
                <li>
                    <a href="{{ route('admin.settlement') }}"
                        class="flex items-center p-2 rounded-lg group
                  {{ request()->routeIs('admin.settlement', 'admin.settlement.details')
                      ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                      : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75
                        {{ request()->routeIs('admin.settlement', 'admin.settlement.details')
                            ? 'text-gray-900 dark:text-white'
                            : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M320 32C373 32 416 75 416 128C416 181 373 224 320 224C267 224 224 181 224 128C224 75 267 32 320 32zM80 368C80 297.9 127 236.6 197.1 203.1C222.4 244.4 268 272 320 272C375.7 272 424.1 240.3 448 194C463.8 182.7 483.1 176 504 176L523.5 176C533.9 176 541.5 185.8 539 195.9L521.9 264.2C531.8 276.6 540.1 289.9 546.3 304L568 304C581.3 304 592 314.7 592 328L592 440C592 453.3 581.3 464 568 464L528 464C511.5 486 489.5 503.6 464 514.7L464 544C464 561.7 449.7 576 432 576L399 576C384.7 576 372.2 566.5 368.2 552.8L361.1 528L278.8 528L271.7 552.8C267.8 566.5 255.3 576 241 576L208 576C190.3 576 176 561.7 176 544L176 514.7C119.5 490 80 433.6 80 368zM456 384C469.3 384 480 373.3 480 360C480 346.7 469.3 336 456 336C442.7 336 432 346.7 432 360C432 373.3 442.7 384 456 384z" />
                        </svg>
                        <span class="flex-1 ms-3">Settlement</span>
                    </a>
                </li>
            @endif
            {{-- Our Merchant --}}
            @if (in_array('M', $per))
                <li>
                    <a href="{{ route('merchant.show') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('merchant.show', 'merchant.create', 'merchant.detail', 'merchant.update', 'sms.show')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75
                            {{ request()->routeIs('merchant.show', 'merchant.create', 'merchant.detail', 'merchant.update', 'sms.show')
                                ? 'text-gray-900 dark:text-white'
                                : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M300.9 149.2L184.3 278.8C179.7 283.9 179.9 291.8 184.8 296.7C215.3 327.2 264.8 327.2 295.3 296.7L327.1 264.9C331.3 260.7 336.6 258.4 342 258C348.8 257.4 355.8 259.7 361 264.9L537.6 440L608 384L608 96L496 160L472.2 144.1C456.4 133.6 437.9 128 418.9 128L348.5 128C347.4 128 346.2 128 345.1 128.1C328.2 129 312.3 136.6 300.9 149.2zM148.6 246.7L255.4 128L215.8 128C190.3 128 165.9 138.1 147.9 156.1L144 160L32 96L32 384L188.4 514.3C211.4 533.5 240.4 544 270.3 544L286 544L279 537C269.6 527.6 269.6 512.4 279 503.1C288.4 493.8 303.6 493.7 312.9 503.1L353.9 544.1L362.9 544.1C382 544.1 400.7 539.8 417.7 531.8L391 505C381.6 495.6 381.6 480.4 391 471.1C400.4 461.8 415.6 461.7 424.9 471.1L456.9 503.1L474.4 485.6C483.3 476.7 485.9 463.8 482 452.5L344.1 315.7L329.2 330.6C279.9 379.9 200.1 379.9 150.8 330.6C127.8 307.6 126.9 270.7 148.6 246.6z" />
                        </svg>
                        <span class="flex-1 ms-3">Our Merchant</span>
                    </a>
                </li>
            @endif

            {{-- Admin Users --}}
            @if (in_array('U', $per))
                <li>
                    <a href="{{ route('user.show') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('user.show', 'user.show.update', 'user.create')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75
                            {{ request()->routeIs('user.show', 'user.show.update', 'user.create')
                                ? 'text-gray-900 dark:text-white'
                                : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3">Admin Users</span>
                    </a>
                </li>
            @endif

            {{-- Admin Access --}}
            @if (in_array('AA', $per))
                <li>
                    <a href="{{ route('access.show') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('access.show', 'access.edit', 'access.create')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i
                            class="fa-solid fa-universal-access
                          {{ request()->routeIs('access.show', 'access.edit', 'access.create')
                              ? 'text-gray-900 dark:text-white'
                              : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        </i>
                        <span class="flex-1 ms-3">Admin Access</span>
                    </a>
                </li>
            @endif

            {{-- Announcement --}}
            @if (in_array('AN', $per))
                <li>
                    <a href="{{ route('support.list') }}"
                        class="flex items-center p-2 rounded-lg group
                      {{ request()->routeIs('support.list', 'support.details', 'support.edit', 'support.show')
                          ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                          : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <i
                            class="fa-solid fa-headset
                          {{ request()->routeIs('support.list', 'support.details', 'support.edit', 'support.show')
                              ? 'text-gray-900 dark:text-white'
                              : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        </i>
                        <span class="flex-1 ms-3">Announcement</span>
                    </a>
                </li>
            @endif

            {{-- Logout --}}
            <li>
                <form action="{{ route('logout') }}" method="POST"
                    class="flex items-center p-2 rounded-lg group
                     text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    @csrf
                    <svg class="w-5 h-5 text-gray-500 transition duration-75
                        group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                    </svg>
                    <button type="submit" class="flex-1 ms-3 text-left">Sign Out</button>
                </form>
            </li>

        </ul>

    </div>
</aside>
