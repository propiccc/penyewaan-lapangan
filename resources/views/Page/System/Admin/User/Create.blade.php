 @extends('Layouts.dashboard')

@section('title')
Dashboard | User
@endsection
@section('content')
<div class="bg-white text-white w-full rounded-lg p-8 shadow-lg shadow-gray-600">

    <div class="flex justify-between items-center">
        <span class="text-xl font-semibold text-black">User Create</span>
    </div>

    <div class="h-[2px] w-full bg-gray-200 my-4"></div>

    <div class="flex flex-col">
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="flex gap-x-2">
                <div class="flex flex-col w-full">
                    <label for="name" class="text-lg font-semibold text-black">Name :</label>
                    <input id="name" type="text" name="name" class= "bg-white text-black p-2 border-[2px] border-gray-500 rounded-md" required>
                    @if (isset($error) && $error === true && isset($message['name']))
                        <span class="text-red-600">{{$message['name'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="email" class="text-lg font-semibold text-black">Email :</label>
                    <input class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" type="text" name="email" id="nama" placeholder="example@gmail.com" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['email']))
                        <span class="text-red-600">{{$message['email'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="no_telp" class="text-lg font-semibold text-black">No Telp :</label>
                    <input class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" type="number" name="no_telp" id="no_telp" placeholder="08821234123" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['no_telp']))
                        <span class="text-red-600">{{$message['no_telp'][0]}}</span>
                    @endif
                </div>
            </div>
            <div class=" flex gap-x-2">
                <div class="flex flex-col w-full">
                    <label for="password" class="text-lg font-semibold text-black">Password :</label>
                    <input class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" type="password" name="password" id="password"  placeholder=""  autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['password']))
                        <span class="text-red-600">{{$message['password'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full"> 
                    <label for="password_confirmation" class="text-lg font-semibold text-black">Password Confirmation :</label>
                    <input class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" type="password" name="password_confirmation" id="password_confirmation" autocomplete="off" required>
                    @if (isset($error) && $error === true && isset($message['password_confirmation']))
                        <span class="text-red-600">{{$message['password_confirmation'][0]}}</span>
                    @endif
                </div>
                <div class="flex flex-col w-full">
                    <label for="role" class="text-lg font-semibold text-black">Role :</label>
                    <select class="p-2 border-[2px] border-gray-500 bg-white text-black rounded-md" name="role" id="role" required>
                        <option class="text-xl text-black p-2" value="admin">Admin</option>
                        <option class="text-xl text-black p-2" value="customer">Customer</option>
                    </select>
                    {{-- <input class="p-2 border-[2px] border-gray-500 rounded-md" type="text" name="tipe" id="tipe" placeholder=""  autocomplete="off"> --}}
                </div>
                @if (isset($error) && $error === true && isset($message['tipe']))
                    <span class="text-red-600">{{$message['tipe'][0]}}</span>
                @endif
            </div>
            <div class="mt-2 flex justify-end gap-x-1">
                <button class="px-5 py-2 bg-blue-700 text-lg font-semibold text-white rounded-lg">Create</button>
                <a href="{{route('user.index')}}" class="px-5 py-2 bg-red-700 text-lg font-semibold text-white rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection