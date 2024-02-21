<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function viewLogin(){
        return view('Page.Auth.Login');
    }

    public function viewRegister(){
        return view('Page.Auth.Register');
    }

    public function login(Request $request){

        $validate = Validator::make($request->all(), [
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:4'],
        ]);

        if ($validate->fails()) {
            $message = [];
            $errors = $validate->errors();
            return view('Page.Auth.Login',[
                'error' => true,
            ]);

            return redirect()->route('login.view')->with(['error' => true  ,'message' => $errors->messages()]);
        }

        $user = User::where('name', $request->username)->orWhere('email', $request->email)->first();

        if(!isset($user)){
            return view('Page.Auth.Login',[
                'error' => true,
            ]);
        }

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return view('Page.Auth.Login',[
                'error' => true,
            ]);
        }
    }

    public function register(Request $request){

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:2'],
            'no_telp' => ['required', 'min:12', 'max:13'],
            'email' => ['required', 'min:2', 'email'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
        ]);

        if ($validate->fails()) {
            $message = [];
            $errors = $validate->errors();
            foreach ($errors->messages() as $err) {
                $message[] = $err[0];
            }
            return view('Page.Auth.Register',[
                'error' => true,
                'message' => $message
            ]);
        }

        $data = User::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('home');
    }

    public function logout(){

        Auth::logout();
        session()->flush();
        return redirect('/');

    }
}

