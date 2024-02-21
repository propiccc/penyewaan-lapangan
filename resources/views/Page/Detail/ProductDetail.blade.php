@extends('Layouts.default')
@section('title')
SEWA LAPANGAN OLARAGA | ROOM DETAIL
@endsection
@section('content')
    <div class="bg-gray-200 flex justify-center min-h-[calc(100vh-60px)] max-h-[calc(100vh-60px)] w-full">
        <div
            class="bg-gray-200 w-[1300px] h-[calc(100vh-60px)] border-x-[2px] border-gray-400 p-5 overflow-scroll scrollbar-none">
            <div class="h-[400px] bg-gray-900 text-white px-6">
                <img class="h-[400px] w-full object-contain bg-gray-900 text-white" src="{{$lapangan->imagedir }}">
            </div>
            <div class="flex gap-x-2 flex-col xl:flex-row">
                <div class="bg-gray-900 text-white rounded-sm mt-2 p-6 flex-col w-full">
                    <span class="text-4xl font-semibold">{{$lapangan->name}}</span>
                    <div class="h-[2px] bg-gray-400 my-3"></div>
                    <span class="text-4xl font-semibold">Rp {{$lapangan->price }}/Jam</span>
                </div>
               
            </div>
            <div class="bg-gray-900 text-white rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Description</span>
                <div class="h-[2px] bg-gray-400 my-3"></div>
                <div class="text-md">
                    {!!$lapangan->description !!}
                </div>
            </div>
            <div class="bg-gray-900 text-white rounded-sm mt-2 w-full p-6 flex-col">
                <a href="{{route('lapangan.sewa.create', ['uuid' =>$lapangan->uuid])}}">
                    <button class="bg-blue-700 w-full rounded-lg font-semibold text-white p-2 mb-2 text-xl active:scale-95 transition-all duration-50">
                        Sewa
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
