<nav class="bg-gray-900 border-gray-200 dark:bg-gray-900 text-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex font-semibold text-lg items-center space-x-3 rtl:space-x-reverse">
            SEWA LAPANGAN
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-900 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-900 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 text-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 rounded  md:p-0 dark:text-white md:bg-transparent  {{ request()->path() == '/' ? 'bg-blue-700  md:dark:text-blue-500 md:text-blue-700' : 'bg-transparent md:text-white' }}" aria-current="page">Home</a>
                </li>
                @if (!auth()->check())
                    <li>
                        <a href="{{ route('login.view') }}" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register.view') }}" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                        </li>
                @endif
                @if (auth()->check())
                    @if (auth()->user()->role == 'admin')               
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Dashboard</a>
                        </li>
                     @endif
                    @if (auth()->user()->role == 'customer')               
                        <li>
                            <a href="{{ route('pemesanan.index') }}" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pemesanan</a>
                        </li>
                     @endif
                        <li>
                            <a href="{{ route('logout') }}"class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Logout</a>
                        </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
