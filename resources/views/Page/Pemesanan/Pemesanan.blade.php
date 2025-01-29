@extends('Layouts.PemesananLayout')
@section('title')
  Pemesanan | SEWA LAPANGAN OLARAGA
@endsection
@section('content')
    <div class="bg-gray-200 h-[calc(100vh-60px)] w-full overflow-scroll scrollbar-none p-10">
        <div class="flex gap-2 flex-wrap">
            @if (count($pemesanan) != 0)
                @foreach ($pemesanan as $item )
                    <div class="w-[350px] p-6 flex flex-col bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$item->Lapangan->name}}</h5>
                        <div class="h-[2px] bg-black mb-3"></div>
                        <span class="mb-3 text-black font-semibold dark:text-gray-400">Rp {{$item->price}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">Tanggal :  {{$item->tanggal_sewa}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">Waktu Sewa :   {{$item->waktu_sewa_mulai}} s/d {{$item->waktu_sewa_selesai}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">
                            Pembayaran :
                                <span class="{{$item->status_pembayaran == 'lunas' || $item->status_pembayaran == 'process'  ? 'text-green-600' : 'text-red-600'}}">
                                    {{strtoupper($item->status_pembayaran)}}
                                </span>
                            </span>
                        <span class="mb-3 text-black  dark:text-gray-400">
                            Status Sewa :
                            <span>
                                    {{strtoupper($item->status_sewa)}}
                            </span>
                        </span>
                        {{-- <span class="mb-3 text-black  dark:text-gray-400">Image Pembayaran :   {{$item->waktu_sewa_mulai}} s/d {{$item->waktu_sewa_selesai}}</span> --}}
                        <div class="h-[2px] bg-black mb-3"></div>
                        <div class="flex w-full gap-x-1">
                            @if ($item->status_pembayaran == 'pending')
                                <a href="{{route('pemesanan.bayar.view', ['uuid' => $item->uuid])}}" class="bg-green-700 text-center w-full p-2 font-semibold text-white rounded-lg">
                                    Bayar
                                </a>
                            @endif
                            <a href="{{route('pemesanan.bayar.view', ['uuid' => $item->uuid])}}" class="bg-blue-700 text-center w-full p-2 font-semibold text-white rounded-lg">
                                Detail
                            </a>
                        </div>
                    </div>

                @endforeach
            @else
                <span class="text-xl text-gray-700">Belum Ada Pemesanan !!!</span>
            @endif

        </div>
    </div>
@endsection
