<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasis';

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_lokasi')->withPivot('stok')->withTimestamps();
    }
}
