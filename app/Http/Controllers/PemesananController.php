<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        $data = Sewa::where('user_id', Auth::user()->id)->get();
        return view('Page.Pemesanan.Pemesanan', [
            'pemesanan' => $data
        ]);
    }

    public function BayarView($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->with(['Lapangan', 'User'])->first();
        if (!isset($data)) {
            return redirect()->route('pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }

        return view('Page.Pemesanan.PemesananBayar', [
            'lapangan' => $data->lapangan,
            'pemesanan' => $data
        ]);
    }

    public function BayarStore(Request $request, $uuid)
    {
        $validate = Validator::make($request->all(), [
            'image_pembayaran' => ['required', 'image', 'mimes:png,jpg'],
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors()->messages();
            foreach ($errors as $error => $val) {
                toastr()->error($val[0], $error);
            }
            return redirect()->route('pemesanan.index');
        }

        $sewa = Sewa::where('uuid', $uuid)->first();
        if (!isset($sewa)) {
            return redirect()->route('pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }

        if ($request->hasFile('image_pembayaran') && $request->image_pembayaran != null) {
            $image = $request->file('image_pembayaran');
            $image_name = Str::random(15) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('/public/ImagePembayaran', $image_name);
            $sewa->image_pembayaran = $image_name;
            $sewa->status_pembayaran = 'process';
            if ($sewa->save()) {

                $dataExpired = Sewa::where([
                    'tanggal_sewa'  => $sewa->tanggal_sewa,
                    'waktu_sewa_mulai' => $sewa->waktu_sewa_mulai,
                    'status_pembayaran' => 'pending',
                ])->delete();

                return redirect()->route('pemesanan.index')->with('success', 'Berhasil Mengupdate Data Sewa !!!');
            } else {
                return redirect()->route('pemesanan.index')->with('error', 'Gagal Update Data Sewa !!!');
            }
        } else {
            return redirect()->route('pemesanan.index')->with('error', 'Masukan Image Dengan Benar !!!');
        }
    }

    public function indexPemesanan()
    {
        $data = Sewa::latest()->get();

        return view('Page.System.Admin.Pemesanan.Index', [
            'data' => $data
        ]);
    }

    public function DetailPemesanan($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->with(['Lapangan', 'User'])->first();
        if (!isset($data)) {
            return redirect()->route('pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }

        return view('Page.System.Admin.Pemesanan.detail', [
            'lapangan' => $data->Lapangan,
            'pemesanan' => $data
        ]);
    }
    public function search(Request $request)
    {

        if ($request->search == null || $request->search == "") return redirect()->route('admin.pemesanan.index');
        $validate = Validator::make($request->all(), [
            'search' => ['required', 'string']
        ]);

        if ($validate->fails()) {
            toastr()->success('Someting Wrong, Try Again!');
            return redirect()->route('admin.pemesanan.index');
        }

        $data = Sewa::where('kode_boking', 'LIKE', '%' . $request->search . '%')->get();
        return view('Page.System.Admin.Pemesanan.Index', [
            'data' => $data
        ]);
    }

    public function TolakPembayaran($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }
        $data->image_pembayaran = null;
        $data->status_pembayaran = 'pending';
        if ($data->save()) {
            return redirect()->route('admin.pemesanan.index')->with('success', 'Berhasil Mengupdate Data Sewa !!!');
        } else {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Gagal Update Data Sewa !!!');
        }
        return back();
    }

    public function TerimaPembayaran($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }
        $data->status_pembayaran = 'lunas';
        if ($data->save()) {
            return redirect()->route('admin.pemesanan.index')->with('success', 'Berhasil Mengupdate Data Sewa !!!');
        } else {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Gagal Update Data Sewa !!!');
        }
    }
    public function SewaMasuk($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }
        $data->status_sewa = 'berjalan';
        if ($data->save()) {
            return redirect()->route('admin.pemesanan.index')->with('success', 'Berhasil Mengupdate Data Sewa !!!');
        } else {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Gagal Update Data Sewa !!!');
        }
    }
    public function SewaSelesai($uuid)
    {
        $data = Sewa::where('uuid', $uuid)->first();
        if (!isset($data)) {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Data Sewa Tidak Di Temukan !!!');
        }
        $data->status_sewa = 'expired';
        if ($data->save()) {
            return redirect()->route('admin.pemesanan.index')->with('success', 'Berhasil Mengupdate Data Sewa !!!');
        } else {
            return redirect()->route('admin.pemesanan.index')->with('error', 'Gagal Update Data Sewa !!!');
        }
    }
}
