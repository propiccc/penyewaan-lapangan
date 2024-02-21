@extends('Layouts.dashboard')
@section('title')
    Admin | Dashboard
@endsection
@section('content')
<div class="flex flex-wrap gap-x-5 w-full justify-start">
    <div class=" h-[200px] w-[350px] rounded-lg flex flex-col shadow-xl">
        <div class="w-full h-[70px] bg-black rounded-t-lg flex items-center px-4 text-xl font-semibold text-white">User :</div>
        <div class="h-full w-full bg-white rounded-b-lg flex justify-center items-center font-semibold text-5xl text-black">
            {{$user}}
        </div>
    </div>
    <div class=" h-[200px] w-[350px] rounded-lg flex flex-col shadow-xl">
        <div class="w-full h-[70px] bg-black rounded-t-lg flex items-center px-4 text-xl font-semibold text-white">Customer :</div>
        <div class="h-full w-full bg-white rounded-b-lg flex justify-center items-center font-semibold text-5xl text-black">
            {{$customer}}
        </div>
    </div>
    <div class=" h-[200px] w-[350px] rounded-lg flex flex-col shadow-xl">
        <div class="w-full h-[70px] bg-black rounded-t-lg flex items-center px-4 text-xl font-semibold text-white">Lapangan :</div>
        <div class="h-full w-full bg-white rounded-b-lg flex justify-center items-center font-semibold text-5xl text-black">
            {{$lapangan}}
        </div>
    </div>
    <div class=" h-[200px] w-[350px] rounded-lg flex flex-col shadow-xl">
        <div class="w-full h-[70px] bg-black rounded-t-lg flex items-center px-4 text-xl font-semibold text-white">Pemesanan :</div>
        <div class="h-full w-full bg-white rounded-b-lg flex justify-center items-center font-semibold text-5xl text-black">
            {{$pesanan}}
        </div>
    </div>
</div>
@endsection