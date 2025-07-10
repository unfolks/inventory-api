<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'kode_produk',
        'kategori',
        'satuan',
    ];
    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class, 'produk_lokasi')->withPivot('stok')->withTimestamps();
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
}
