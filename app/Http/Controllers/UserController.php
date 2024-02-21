<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('Page.System.Admin.User.Index', [
            'user' => $data
        ]);
    }
    public function create(){
        return view('Page.System.Admin.User.Create');
    }

    public function search(Request $request){

        if($request->search == null || $request->search == "" ) return redirect()->route('user.index');
        $validate = Validator::make($request->all(), [
            'search' => ['required', 'string']
        ]);
        
        if ($validate->fails()) {
            toastr()->success('Someting Wrong, Try Again!');
            return redirect()->route('user.index');
        }

        $data = User::where('name', 'LIKE', '%' . $request->search . '%')
        ->orWhere('role', 'LIKE', '%' . $request->search . '%')
        ->orWhere('email', 'LIKE', '%' . $request->search . '%')
        ->get();

        return view('Page.Dashboard.Admin.User.Index', [
            'user' => $data
        ]);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => ['required','string','min:4'],
            'email' => ['required', 'string', 'email'],
            'no_telp' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:4','confirmed'],
        ]);
        
        
        if ($validate->fails()) {
            $message = [];
            $errors = $validate->errors()->messages();
            foreach ($errors as $error => $val) {
                toastr()->error($val[0], $error);
            }
            return view('Page.System.Admin.User.Create');
        }
        
        $req = $request->all();
        $data = User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'no_telp' => $req['no_telp'],
            'role' => $req['role'],
            'password' => Hash::make($req['password'])
        ]);   

        if ($data) {
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('user.index');
        } else {
            toastr()->error('Data Falied To Save!');
            return redirec()->route('user.index');
        }

    }

    public function edit($uuid){

        $data = User::where('uuid', $uuid)->first();

        if (!isset($data))  {
            return redirect()->route('user.index')->withErrors(['errror' => 'Data Tidak Di Temukan']);
        }
        
        return view('Page.System.Admin.User.Edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $uuid){

        $validate = Validator::make($request->all(), [
            'name' => ['required','string','min:4'],
            'email' => ['required', 'string', 'email'],
            'no_telp' => ['required', 'string'],
            'role' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:4','confirmed'],
        ]);
        
        if ($validate->fails()) {
            $message = [];
            $errors = $validate->errors()->messages();
            foreach ($errors as $error => $val) {
                toastr()->error($val[0], $error);
            }
            return redirect()->route('user.edit', ['uuid' => $uuid]);
        }
        
        $data = User::where('uuid', $uuid)->first();
        if (!isset($data))  {
            return redirect()->route('user.index')->withErrors(['errror' => 'Data Tidak Di Temukan']);
        }
        $req = $request->all();
         if($req['password'] == null){
            unset($req['password']);
            unset($req['password_confirnmatin']);
        }
        $data->update($req);
        
        if ($data) {
            toastr()->success('Data successfully Updated!');
            return redirect()->route('user.index');
        } else {
            toastr()->error('Data Falied To Save!');
            return redirec()->route('user.index');
        }

    }

    public function delete($uuid){
        $data = User::where('uuid', $uuid)->first();
        if (!isset($data)) {
            toastr()->error('No Data Found!');
            return redirect()->route('user.index');
        }
        if ($data->delete()) {
            toastr()->success('Data successfully Delete!');
            return redirect()->route('user.index');
        } else {
            toastr()->error('Data Falied To Delete!');
            return redirec()->route('user.index');
        }
        
    }
}
