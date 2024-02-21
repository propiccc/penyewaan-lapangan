<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Lapangan extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    protected $appends = ['imagedir'];

    public function getImagedirAttribute()
    {
        return asset('storage/lapanganImage/' . $this->image);
    }
}
