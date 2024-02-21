<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body>
    <div class="bg-black scrollbar-none flex overflow-scroll min-h-screen max-h-screen">

        {{-- Menu Start --}}
        <div class="bg-black w-[350px] flex flex-col text-white">
            <a href="{{ '/' }}"
                class="bg-black h-[70px] text-3xl font-semibold flex items-center justify-center text-blue-500 border-b-2 border-white">
                Sewa<span class="text-white">Lapangan</span>
            </a>
            <div class="bg-black flex flex-col h-full overflow-scroll scrollbar-none px-3 py-5 gap-y-2 text-white">
                <a href="{{ route('admin.dashboard') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/dashboard' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Dashboard</a>
                <a href="{{ route('user.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/user' || request()->path() == 'admin/user/create' || Request::is('admin/user/*/edit') || request()->path() == 'admin/user/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">User</a>
                <a href="{{ route('lapangan.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/lapangan' || request()->path() == 'admin/lapangan/create' || Request::is('admin/lapangan/*/edit') || request()->path() == 'admin/lapangan/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Lapangan</a>
                <a href="{{ route('admin.pemesanan.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/pemesanan' || request()->path() == 'admin/pemesanan/create' || Request::is('admin/pemesanan/*/edit') || request()->path() == 'admin/pemesanan/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Pemesanan</a>
            </div>
        </div>
        {{-- Menu End --}}

        {{-- Container Content Start --}}
        <div class="bg-black w-full flex flex-col">
            {{-- Navbar Start --}}
            <div class="bg-black h-[70px] flex items-center justify-end px-5 gap-x-4 border-b-2 border-white">
                <a href="{{ route('home') }}" class="font-semibold text-lg hover:text-gray-300 text-white">Home</a>
                <a href="{{ route('logout') }}" class="font-semibold text-lg hover:text-gray-300 text-white">Logout</a>
            </div>
            {{-- Navbar End --}}
            <div class="bg-gray-300 h-full p-10 overflow-hidden">
                <div class="bg-transparent max-h-full overflow-scroll scrollbar-none p-5">
                    @yield('content')
                </div>
            </div>
        </div>
        {{-- Container Content Start --}}
    </div>
    @yield('scripts')
</body>
<style>
    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }
</style>

</html>
