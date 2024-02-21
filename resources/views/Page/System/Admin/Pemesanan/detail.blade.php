@extends('Layouts.default')
@section('title')
SEWA LAPANGAN OLARAGA | ROOM DETAIL
@endsection
@section('content')
    <div class="bg-gray-200 flex justify-center min-h-[calc(100vh-60px)] max-h-[calc(100vh-60px)] w-full">
        <div
            class="bg-gray-200 w-[1300px] h-[calc(100vh-60px)] border-x-[2px] border-gray-400 p-5 overflow-scroll scrollbar-none">
            <div class="h-[400px] bg-gray-900  text-white px-6">
                <img class="h-[400px] w-full object-contain bg-gray-900" text-white  src="{{ $lapangan->imagedir }}">
            </div>
            <div class="flex gap-x-2 flex-col xl:flex-row">
                <div class="bg-gray-900  text-white rounded-sm mt-2 p-6 flex-col w-full">
                    <span class="text-4xl font-semibold">{{ $lapangan->name }}</span>
                    <div class="h-[2px] bg-gray-800 my-3"></div>
                    <span class="text-4xl font-semibold">Rp {{ $lapangan->price }}/Jam</span>
                </div>
            </div>
            <div class="bg-gray-900  text-white rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Description</span>
                <div class="h-[2px] bg-gray-800 my-3"></div>
                <div class="text-md">
                    {!! $lapangan->description !!}
                </div>
            </div>
            <div class="bg-gray-900  text-white rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Detail Sewa</span>
                <div class="h-[2px] bg-gray-800 my-3"></div>
                <div class="text-md flex flex-col">
                    <span class="mb-3 text-white font-semibold dark:text-gray-400">Harga Sewa : Rp {{$pemesanan->price}}</span>
                        <span class="mb-3 text-white  dark:text-gray-400">Tanggal :  {{$pemesanan->tanggal_sewa}}</span>
                        <span class="mb-3 text-white  dark:text-gray-400">Waktu Sewa :   {{$pemesanan->waktu_sewa_mulai}} s/d {{$pemesanan->waktu_sewa_selesai}}</span>
                        <span class="mb-3 text-white  dark:text-gray-400">
                            Pembayaran :  
                            <span class="{{$pemesanan->status_pembayaran == 'lunas' || $pemesanan->status_pembayaran == 'process'  ? 'text-green-600' : 'text-red-600'}}">
                                {{strtoupper($pemesanan->status_pembayaran)}}
                            </span>
                        </span>
                        <span class="mb-3 text-white  dark:text-gray-400">
                            Status Sewa :  
                            <span>
                                {{strtoupper($pemesanan->status_sewa)}}
                            </span>
                        </span>
                        <span class="mb-3 text-white  dark:text-gray-400">Image Pembayaran : </span>
                        <div class=" flex justify-center bg-gray-200 p-2">
                            @if ($pemesanan->image_pembayaran != null)
                                <a href="{{$pemesanan->imagedir}}" target="_blank">
                                    <img src="{{$pemesanan->imagedir}}" alt="">
                                </a>
                            @else
                                <span class="font-semibold text-lg">Belum Bayar</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-lg mt-3 bg-gray-900  text-white p-6">
                    Click Di Sini Untuk <a class="text-blue-600" href="{{route('admin.pemesanan.index')}}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
