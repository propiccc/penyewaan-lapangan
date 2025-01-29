@extends('Layouts.default')
@section('title')
    Home | SEWA LAPANGAN OLARAGA
@endsection
@section('content')
<div class="flex w-full h-[800px] justify-center items-center">

    <img class="w-full object-fill h-[800px] absolute -z-10" src="https://www.blibli.com/friends-backend/wp-content/uploads/2023/10/B1000209-Cover-lapangan-di-jakarta-selatan.jpg  " alt="" srcset="">
    <div class="flex flex-col text-white font-semibold">
        <span class="bg-black p-4 text-4xl text-center">
            Selamat Datang Di Penyewaan Lapangan Online
        </span>
        <span class=" text-center text-4xl bg-black p-4 font-semibold">
            Silahkan Pilih Lapangan Sesuai Keinginan Anda
        </span>
    </div>
</div>
    <div class="flex bg-blue-500">
        <div class="flex flex-col-reverse h-full w-full xl:flex-row">
            <div class="bg-gray-800 text-white p-8 xl:w-1/2 flex flex-col">
                <span class="font-bold text-4xl">SEWA LAPANGAN FUTSAL</span>
                <div class="h-[2px] w-full bg-white my-3"></div>
                <p class="text-2xl font-semibold text-start">
                   Selamat datang di tempat penyewaan lapangan kami, tempat di mana semangat olahraga dan kebersamaan bersatu! Kami dengan bangga mempersembahkan fasilitas terbaik untuk memenuhi kebutuhan kegiatan olahraga dan rekreasi Anda.
                   Di sini, kami menyediakan lapangan yang luas dan nyaman untuk berbagai jenis kegiatan olahraga, mulai dari sepak bola, basket, tenis, hingga voli. Apakah Anda seorang atlet yang berdedikasi atau hanya mencari tempat untuk bersenang-senang bersama teman dan keluarga, lapangan kami siap melayani semua kebutuhan Anda.
                </p>
                <div class="flex mt-10">
                    <a href="#shop"
                        class="p-4 border-[2px] border-white hover:bg-white duration-300 transition-all hover:text-black font-semibold">Sewa
                        Lapangan Sekarang</a>
                </div>
            </div>
            <div class="h-full xl:w-1/2">
                <img class="h-full w-full"
                    src="https://superlive.id/storage/articles/aeae881e-e955-46c7-9b85-9823f5b56a7a.jpg"
                    alt="">
            </div>
        </div>
    </div>
    {{-- * Card Start --}}
    @if (count($lapangan) != 0)
        <div class="flex w-full flex-col  bg-black p-8">
            <div class="flex justify-center">
                <span class="font-bold text-4xl text-white">Sewa Lapangan Di Sini</span>
            </div>
            {{-- Produk Start --}}
            <div class="h-[2px] bg-white w-full my-5"></div>
            <div class="flex gap-3 justify-center">
                @foreach ($lapangan as $item)
                <div
                        class="w-[400px] bg-gray-800 border border-gray-400 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a class="" href="{{ route('lapangan.detail', ['uuid' => $item->uuid]) }}">
                            <img class="rounded-t-lg object-cover h-[220px] w-full bg-black" src="{{$item->imagedir }}"
                                alt="" />
                        </a>
                        <div class="p-5">
                            <span class="overflow-hidden text-2xl text-white">
                                Rp {{$item->price}}.00
                            </span>
                            <a href="{{ route('lapangan.detail', ['uuid' => $item->uuid]) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">
                                    {{ $item->name }}</h5>
                            </a>
                            <div class="h-[150px] overflow-hidden text-white">
                                {!! $item->description !!}
                            </div>
                            <a href="{{ route('lapangan.detail', ['uuid' => $item->uuid]) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                SEWA LAPANGAN
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Produk End --}}
        </div>
    @endif

    {{-- * Card End --}}

    {{-- * Lokasi Start --}}
    <div class="flex h-[1000px] flex-col">
        <div class="bg-black p-5 flex flex-col items-center">
            <span class="text-5xl font-bold text-center text-white">Kunjungi Lokasi Kami</span>
            <div class="h-[2px] bg-white w-full my-5"></div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1013898.8725475085!2d113.99247201736871!3d-6.945151739497945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9503d619c43%3A0x411d4cbbe989434!2sSMK%20Negeri%202%20Surabaya!5e0!3m2!1sid!2sid!4v1702280181145!5m2!1sid!2sid"
            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    {{-- * Lokasi Ends --}}

    {{-- * Footer Start --}}
    <footer class="bg-white shadow dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4">
            <div class="sm:flex justify-center">
                <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse justify-center">
                    <span class="text-2xl font-semibold whitespace-nowrap dark:text-white">SEWA LAPANGAN</span>
                </a>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-center text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://flowbite.com/" class="hover:underline">SEWAROOMMETTING</a>. All Rights Reserved.</span>
        </div>
    </footer>
    {{-- * Footer End --}}
@endsection
