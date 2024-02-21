<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\User;
use App\Models\Bunga;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(){
        $lapangan = Lapangan::latest()->get();
        return view('Page.Home.Index', [
            'lapangan' => $lapangan
        ]);
    }

}
