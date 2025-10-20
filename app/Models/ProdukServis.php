<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukServis extends Model
{
    protected $table = 'produk_servis';

    protected $fillable = [
        'nama',
        'keterangan',
        'harga',
        'kategori_harga',
        'jenis',
        'perniagaan_id',
    ];

    public function perniagaan()
    {
        return $this->belongsTo(Perniagaan::class, 'perniagaan_id');
    }
}
