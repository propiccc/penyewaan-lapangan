<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LapanganController extends Controller
{
    
    public function LapanganDetail($uuid){
    
        $lapangan = Lapangan::where('uuid', $uuid)->first();
        return view('Page.Detail.ProductDetail',[
            'lapangan' => $lapangan
        ]);
    }
    public function index(){
        $data = Lapangan::get();
        return view('Page.System.Admin.lapangan.Index',[
            'lapangan' => $data
        ]);
    }

    public function create(){
        return view('Page.System.Admin.lapangan.Create');
    }
    
    public function store(Request $request){
        $validate = Validator::make($request->all(), [

            'name' => ['required', 'string', 'min:2'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'image' => ['required', 'file', 'mimes:png,jpg']
        ]);

        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('lapangan.create');
        }

        $req = $request->all();
        if($request->hasFile('image') && $request->image != null){
            $image = $request->file('image');
            $image_name = Str::random(15) .'.' . $image->getClientOriginalExtension();
            $image->storeAs('/public/lapanganImage', $image_name);
            $req['image'] = $image_name;
        } else {
            toastr()->error('Image Is Required!!!');
            return redirect()->route('lapangan.create');
        }
    
        $data = Lapangan::create([
            'name'  => $req['name'],
            'price' => $req['price'],
            'description' => $req['description'],
            'image' => $req['image']
        ]);

        if($data){
            return redirect()->route('lapangan.index')->with('success', 'Data Berhasil Di Buat!!!');
        } else {
            return redirect()->route('lapangan.index')->with('error', 'Data Gagal Di Buat!!!');
        }

    }

    public function edit($uuid){
        $data = Lapangan::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('lapangan.index')->with('error','Data Tidak Di Temukan!');
        }
        
        return view('Page.System.Admin.lapangan.Edit', [
            'lapangan' => $data
        ]);
    
    }

    public function update(Request $request, $uuid){
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'image' => ['nullable', 'file', 'mimes:png,jpg']
        ]);

        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('lapangan.edit', ['uuid' => $uuid]);
        }

        $req = $request->all();
        $lapangan = Lapangan::where('uuid', $uuid)->first();
        if (!isset($lapangan)) {
            return redirect()->route('lapangan.index')->with('error','Data Tidak Di Temukan!');
        }        

        if($request->hasFile('image') && $request->image != null){
            $image = $request->file('image');
            $image_name = Str::random(15) .'.' . $image->getClientOriginalExtension();
            $image->storeAs('/public/lapanganImage', $image_name);
            Storage::delete("/public/lapanganImage/" . $lapangan->image);
            $req['image'] = $image_name;
        } else {
            unset($req['image']);
        }
    
        $lapangan->update($req);

        if($lapangan){
            return redirect()->route('lapangan.index')->with('success', 'Data Berhasil Di Update!!!');
        } else {
            return redirect()->route('lapangan.index')->with('error', 'Data Gagal Di Update!!!');
        }

    }

    public function delete($uuid){
        $data = Lapangan::where('uuid', $uuid)->first();
        
        if (!isset($data)) {
            return redirect()->route('lapangan.index')->with('error','Data Tidak Di Temukan!');
        } else {
            Storage::delete("/public/lapanganImage/" . $data->image);
        }
        
        if($data->delete()){
            return redirect()->route('lapangan.index')->with('success', 'Data Berhasil Di Delete!!!');
        } else {
            return redirect()->route('lapangan.index')->with('error', 'Data Gagal Di Delete!!!');
        }

    }
}
