<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Sewa;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SewaController extends Controller
{
    public function SewaCreate($uuid){
        $lapangan = Lapangan::where('uuid', $uuid)->first();
        return view('Page.Sewa.SewaForm', [
            'lapangan' => $lapangan
        ]);
    }

    public function SewaStore(Request $request, $uuid){

        $waktuSekarang = Carbon::now('Asia/Jakarta')->format('H:i');
        $tanggalSekarang = Carbon::now('Asia/Jakarta')->startOfDay();

        $validate = Validator::make($request->all(), [
            'tanggal_sewa' => ['required','date','after_or_equal:' . $tanggalSekarang->toDateString()],
            'waktu_sewa_mulai' => ['required','date_format:H:i','after_or_equal:' . $waktuSekarang],
            'waktu_sewa_selesai' => ['required','date_format:H:i','after:waktu_sewa_mulai',],
        ]);

        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('lapangan.sewa.create', ['uuid' => $uuid]);
        }

        // * Check tanggal dan waktu ada yang memesan atau tidak

        $time_start = Carbon::parse($request->waktu_sewa_mulai);
        $time_end   = Carbon::parse($request->waktu_sewa_selesai);

        $check = Sewa::where('tanggal_sewa', $request->tanggal_sewa)
                ->where('waktu_sewa_mulai', '<=', $time_start || 'waktu_sewa_mulai', '>=', $time_start)
                ->where('waktu_sewa_selesai', '>=', $time_end)
                ->where('status_pembayaran', 'lunas')->first();


        if(isset($check)){
            toastr()->warning('Tanggal Dan Waktu Sudah Di Boking !!!', 'Warning');
            return redirect()->route('lapangan.sewa.create' ,['uuid' => $uuid]);
        }

        $lapangan = Lapangan::where('uuid', $uuid)->first();
        if(!isset($lapangan)){
            return redirect()->route('lapangan.sewa.create', ['uuid' => $uuid])->with('error', 'Room Tidak Di Temukan !!!');
        }



        $jam = $time_end->diffInMinutes($time_start, true);
        if ($jam % 60 !== 0) {
            $jam = (int)($jam / 60) + 1;
        } else {
            $jam = $jam / 60;
        }

        $randomNumber = rand(pow(10, 4-1), pow(10, 4)-1);
        $randomNumberString = (string) $randomNumber;
        $HARGA_SEWA = (int)$lapangan->price * $jam;
        $KODE_BOKING = date('dmYHis') . $randomNumberString;

        $sewaRoom =  Sewa::create([
            'tanggal_sewa' => $request->tanggal_sewa,
            'waktu_sewa_mulai' => $request->waktu_sewa_mulai,
            'waktu_sewa_selesai' => $request->waktu_sewa_selesai,
            'lapangan_id' => $lapangan->id,
            'user_id' => Auth::user()->id,
            'price' => $HARGA_SEWA,
            'kode_boking' => $KODE_BOKING
        ]);

        if ($sewaRoom) {
            return redirect()->route('pemesanan.index')->with('success', 'Data Penyewaan Berhasil Di Buat !!!');
        } else {
            return redirect()->route('lapangan.sewa.create', ['uuid'  => $uuid])->with('error', 'Data Gagal Di Buat !!!');
        }

    }
}
