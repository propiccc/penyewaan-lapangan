@extends('Layouts.default')
@section('title')
SEWA LAPANGAN OLARAGA | ROOM DETAIL
@endsection
@section('content')
    <div class="bg-gray-200 flex justify-center min-h-[calc(100vh-60px)] max-h-[calc(100vh-60px)] w-full">
        <div
            class="bg-gray-200 w-[1300px] h-[calc(100vh-60px)] border-x-[2px] border-gray-400 p-5 overflow-scroll scrollbar-none text-white">
            <div class="h-[400px] bg-gray-900 px-6">
                <img class="h-[400px] w-full object-contain bg-gray-900" src="{{$lapangan->imagedir }}">
            </div>
            <div class="flex gap-x-2 flex-col xl:flex-row">
                <div class="bg-gray-900 rounded-sm mt-2 p-6 flex-col w-full">
                    <span class="text-4xl font-semibold">{{$lapangan->name}}</span>
                    <div class="h-[2px] bg-gray-800 my-3"></div>
                    <span class="text-4xl font-semibold">Rp {{$lapangan->price }}/Jam</span>
                </div>
            </div>
            <div class="bg-gray-900 rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Description</span>
                <div class="h-[2px] bg-gray-800 my-3"></div>
                <div class="text-md">
                    {!!$lapangan->description !!}
                </div>
            </div>
            <div class="bg-gray-900 rounded-sm mt-2 p-6 flex gap-x-2 flex-col">
                <div class="">
                    <span class="text-3xl font-semibold">Form Penyewaan</span>
                </div>

            <div class="h-[2px] bg-gray-800 my-4"></div>

            <form action="{{route('lapangan.sewa.store', ['uuid' =>$lapangan->uuid])}}" method="POST">
                @csrf
                @method('POST')
                <div class="flex gap-x-2 text-black">
                    <div class="flex flex-col w-full">
                        <label for="time_start" class="font-semibold text-white text-xl mb-1">Tanggal Sewa : </label>
                        <input type="date" name="tanggal_sewa" autocomplete="off" required>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="time_start" class="font-semibold text-white text-xl mb-1">Waktu Sewa Mulai : </label>
                        <input type="time" name="waktu_sewa_mulai"  autocomplete="off">
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="time_start" class="font-semibold text-white text-xl mb-1">Waktu Sewa Selesai : </label>
                        <input type="time" name="waktu_sewa_selesai">
                    </div>
                </div>
                <div class="flex flex-col w-full mt-2">
                   <button type="submit" class="bg-blue-700 w-full rounded-lg font-semibold text-white p-2 mb-2 text-xl active:scale-95 transition-all duration-50">Sewa</button>
                </div>
            </form>
               
            </div>
        </div>
    </div>
@endsection
