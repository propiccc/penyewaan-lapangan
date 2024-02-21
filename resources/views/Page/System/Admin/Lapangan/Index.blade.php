@extends('Layouts.dashboard')
@section('title')
    Admin | lapangan
@endsection
@php
  $i = 1;
@endphp
@section('content')
<div class="bg-white text-black w-full rounded-lg p-8 shadow-lg shadow-gray-600">
    <div class="flex justify-between items-center">
        <span class="text-xl font-semibold text-black">lapangan Data</span>
        <a href="{{route('lapangan.create')}}">
            <button class="px-5 py-2 rounded-lg bg-blue-700 font-semibold text-white transition-all duration-300 active:scale-90">Add</button>
        </a>
    </div>
    <div class="h-[2px] w-full bg-gray-200 my-4"></div>
    {{-- <div class="flex mb-4">
        <form action="{{route('lapangan.search')}}" method="POST" class="m-0 flex">
            @csrf
            @method("POST")
            <input name="search" type="text" class="py-2 border-gray-400 border-2 rounded-tl-lg rounded-bl-lg px-2 w-[150px] focus:outline-blue-500 h-full" placeholder="Search" autocomplete="off">
            <button class="bg-gray-500 hover:bg-blue-700 font-semibold h-full px-3 text-black rounded-tr-lg rounded-br-lg">Search</button>
        </form>
    </div> --}}
    <div class="">
        <table class="bg-white w-full text-black">
           <thead class="w-full h-[40px] bg-gray-800 text-white">
                <tr class="w-full"> 
                    <th class="w-[50px]">No.</th>
                    <th class="text-center w-[170px]">Image</th>
                    <th class="">lapangan Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
           </thead>
           <tbody class="text-center h-full">
            @if (count($lapangan) != 0)
                @foreach ($lapangan as $item )
                    <tr class="h-[50px] border-b-[1px] border-gray-200">
                        <td>{{ $i++ }}</td>
                        <td class="p-2">
                            <a href="{{$item->imagedir}}" target="_blank">
                                <img src="{{$item->imagedir}}" class="bg-gray-200 rounded-md h-[100px] w-[150px]" alt="foto">
                            </a>
                        </td>
                        <td>{{$item->name}}</td>
                        <td>Rp {{number_format($item->price, 3, ',', '.')}}.00</td>
                        <td class="">
                            <a href="{{route('lapangan.edit',['uuid' => $item->uuid])}}" class="px-4 py-2 text-black bg-yellow-300 rounded-lg font-semibold transition-all duration-300 hover:scale-105 active:scale-95">Edit</a>
                            <a  href="{{route('lapangan.delete',['uuid' => $item->uuid])}}" class="px-4 py-2 text-white bg-red-600 rounded-lg font-semibold transition-all duration-300 active:scale-95 cursor-pointer">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else   
                <tr  class="bg-gray-200 h-[50px]">
                    <th colspan="7" class="text-start text-black px-2">Data Not Found</th>
                </tr>
            @endif
           </tbody>
        </table>
    </div>
</div>
@endsection
