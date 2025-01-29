@extends('Layouts.dashboard')
@section('title')
    Admin | Pemesanan
@endsection
@php
  $i = 1;
@endphp
@section('content')
<div class="bg-white text-black w-full rounded-lg p-8 shadow-lg shadow-gray-600">
    <div class="flex justify-between">
        <span class="text-xl font-semibold text-black">Pemesanan Data</span>
        <div class="flex justify-end">
            <form action="{{route('admin.pemesanan.search')}}" method="POST" class="m-0 flex">
                @csrf
                @method("POST")
                <input name="search" type="text" class="py-2 border-gray-400 border-2 rounded-tl-lg rounded-bl-lg px-2 w-[150px] focus:outline-none active:outline-none h-full" placeholder="Search" autocomplete="off">
                <button class="bg-gray-400 hover:bg-blue-700 font-semibold h-full px-3 text-black rounded-tr-lg rounded-br-lg">Search</button>
            </form>
        </div>
        {{-- <a href="{{route('user.create')}}">
            <button class="px-5 py-2 rounded-lg bg-blue-700 font-semibold text-white transition-all duration-300 active:scale-90">Add</button>
        </a> --}}
    </div>
    <div class="h-[2px] w-full bg-gray-200 my-5"></div>
    <div class="">
        <table class="bg-white w-full text-black">
           <thead class="w-full h-[40px] bg-gray-800 text-white">
                <tr class="w-full">
                    <th class="w-[50px]">No.</th>
                    <th class="w-[200px]">Image Pembayaran</th>
                    <th>Kode Boking</th>
                    <th>Nama User</th>
                    <th>Nama Lapangan</th>
                    <th>Tanggal Sewa</th>
                    <th>Waktu Sewa</th>
                    <th>Status pembayaran</th>
                    <th>Status Sewa</th>
                    <th>Action</th>
                </tr>
           </thead>
           <tbody class="text-center h-full">
            @if (count($data) != 0)
                @foreach ($data as $item )
                    <tr class="h-[100px] border-b-[1px] border-gray-200 {{$i % 2 ? 'bg-white' : 'bg-gray-100'}}">
                        <td>{{ $i++ }}</td>
                        <td class="p-2 flex justify-center">
                            @if ($item->image_pembayaran != null)
                                <a href="{{$item->imagedir}}" target="_blank">
                                <img src="{{$item->imagedir}}" class="bg-gray-200 rounded-md h-[100px] w-[150px]" alt="foto">
                                </a>

                            @else
                                <span class="font-semibold text-lg">
                                    Belum Bayar
                                </span>
                            @endif
                        </td>
                        <td>{{$item->kode_boking}}</td>
                        <td>{{$item->User->name}}</td>
                        <td>{{$item->Lapangan->name }}</td>
                        <td>{{$item->tanggal_sewa}}</td>
                        <td>{{$item->waktu_sewa_mulai}} s/d {{$item->waktu_sewa_selesai}}</td>
                        <td>{{strtoupper($item->status_pembayaran)}}</td>
                        <td>{{strtoupper($item->status_sewa)}}</td>
                        <td class="">
                            <a href="{{route('admin.pemesanan.detail',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-purple-600 rounded-lg font-semibold transition-all duration-300 active:scale-95">Detail</a>
                            @if ($item->status_pembayaran == 'process' && $item->image_pembayaran != null)
                                <a href="{{route('admin.pemesanan.terima',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-green-600 rounded-lg font-semibold transition-all duration-300 active:scale-95">Terima</a>
                                <a  href="{{route('admin.pemesanan.tolak',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-red-600 rounded-lg font-semibold transition-all duration-300 active:scale-95 cursor-pointer">Tolak</a>
                            @endif
                            @if($item->status_pembayaran == 'lunas' && $item->status_sewa == 'pending')
                                <a  href="{{route('admin.pemesanan.masuk',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-green-600 rounded-lg font-semibold transition-all duration-300 active:scale-95 cursor-pointer">Masuk</a>
                                @endif
                            @if($item->status_pembayaran == 'lunas' && $item->status_sewa == 'berjalan')
                                <a  href="{{route('admin.pemesanan.selesai',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-red-600 rounded-lg font-semibold transition-all duration-300 active:scale-95 cursor-pointer">Selesai</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr  class="bg-gray-200 h-[50px]">
                    <th colspan="10" class="text-start text-black px-2">Data Not Found</th>
                </tr>
            @endif
           </tbody>
        </table>
    </div>
</div>
@endsection
