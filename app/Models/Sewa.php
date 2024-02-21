<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Traits\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sewa extends Model
{
    use HasFactory, Uuid;
    protected $fillable = [
        'status_sewa',
        'status_pembayaran',
        'kode_boking',
        'tanggal_sewa',
        'waktu_sewa_mulai',
        'waktu_sewa_selesai',
        'image_pembayaran',
        'price',
        'user_id',
    'lapangan_id',
    ];

    public function User(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Lapangan(){
        return $this->hasOne(Lapangan::class, 'id', 'lapangan_id');
    }

    protected $appends = ['imagedir'];

    public function getImagedirAttribute()
    {
        return asset('storage/ImagePembayaran/' . $this->image_pembayaran);
    }

    public function updateStatus()
    {
        $now = Carbon::now();
        $waktuMulai = Carbon::createFromFormat('Y-m-d H:i:s', $this->tanggal_sewa . ' ' . $this->waktu_sewa_mulai);
        $waktuSelesai = Carbon::createFromFormat('Y-m-d H:i:s', $this->tanggal_sewa . ' ' . $this->waktu_sewa_selesai);

        $now->gt($waktuSelesai) && $now->gt($waktuMulai);
        if ($this->status_pembayaran === 'lunas') {
            if ($now->eq($waktuMulai) || $now->gt($waktuMulai) && $now->lt($waktuSelesai)) {
                $this->update(['status_sewa' => 'berjalan']);
            }
            if($now->gt($waktuSelesai) && $now->gt($waktuMulai) || $now->eq($waktuSelesai)) {
                $this->update(['status_sewa' => 'expired']);
            }
        }
    }
}
