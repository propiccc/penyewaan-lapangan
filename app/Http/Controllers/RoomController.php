<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{


    public function RoomDetail($uuid){
    
        $room = Room::where('uuid', $uuid)->first();
        return view('Page.Detail.ProductDetail',[
            'room' => $room
        ]);
    }
    public function index(){
        $data = Room::get();
        return view('Page.System.Admin.Room.Index',[
            'room' => $data
        ]);
    }

    public function create(){
        return view('Page.System.Admin.Room.Create');
    }
    
    public function store(Request $request){
        $validate = Validator::make($request->all(), [

            'room_name' => ['required', 'string', 'min:2'],
            'capacity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'image' => ['required', 'file', 'mimes:png,jpg']
        ]);

        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('room.create');
        }

        $req = $request->all();
        if($request->hasFile('image') && $request->image != null){
            $image = $request->file('image');
            $image_name = Str::random(15) .'.' . $image->getClientOriginalExtension();
            $image->storeAs('/public/RoomImage', $image_name);
            $req['image'] = $image_name;
        } else {
            toastr()->error('Image Is Required!!!');
            return redirect()->route('room.create');
        }
    
        $data = Room::create([
            'room_name'  => $req['room_name'],
            'capacity' => $req['capacity'],
            'price' => $req['price'],
            'description' => $req['description'],
            'image' => $req['image']
        ]);

        if($data){
            return redirect()->route('room.index')->with('success', 'Data Berhasil Di Buat!!!');
        } else {
            return redirect()->route('room.index')->with('error', 'Data Gagal Di Buat!!!');
        }

    }

    public function edit($uuid){
        $data = Room::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('room.index')->with('error','Data Tidak Di Temukan!');
        }
        
        return view('Page.System.Admin.Room.Edit', [
            'room' => $data
        ]);
    
    }

    public function update(Request $request, $uuid){
        $validate = Validator::make($request->all(), [
            'room_name' => ['required', 'string', 'min:2'],
            'capacity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:png,jpg']
        ]);

        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('room.edit', ['uuid' => $uuid]);
        }

        $req = $request->all();
        $room = Room::where('uuid', $uuid)->first();
        if (!isset($room)) {
            return redirect()->route('room.index')->with('error','Data Tidak Di Temukan!');
        }        

        if($request->hasFile('image') && $request->image != null){
            $image = $request->file('image');
            $image_name = Str::random(15) .'.' . $image->getClientOriginalExtension();
            $image->storeAs('/public/RoomImage', $image_name);
            Storage::delete("/public/RoomImage/" . $room->image);
            $req['image'] = $image_name;
        } else {
            unset($req['image']);
        }
    
        $room->update($req);

        if($room){
            return redirect()->route('room.index')->with('success', 'Data Berhasil Di Update!!!');
        } else {
            return redirect()->route('room.index')->with('error', 'Data Gagal Di Update!!!');
        }

    }

    public function delete($uuid){
        $data = Room::where('uuid', $uuid)->first();
        
        if (!isset($data)) {
            return redirect()->route('room.index')->with('error','Data Tidak Di Temukan!');
        } else {
            Storage::delete("/public/RoomImage/" . $data->image);
        }
        
        if($data->delete()){
            return redirect()->route('room.index')->with('success', 'Data Berhasil Di Delete!!!');
        } else {
            return redirect()->route('room.index')->with('error', 'Data Gagal Di Delete!!!');
        }

    }
}
