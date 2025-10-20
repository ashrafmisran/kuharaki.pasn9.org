<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perniagaan extends Model
{
    protected $table = 'perniagaan';

    protected $fillable = [
        'nama',
        'pemilik',
        'kategori',
        'no_telefon',
        'emel',
        'alamat_baris_1',
        'alamat_baris_2',
        'poskod',
        'bandar_id',
        'negeri_id',
        'latitude',
        'longitude',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik');
    }

    public function industri()
    {
        return $this->belongsToMany(Industri::class, 'industri_perniagaan', 'perniagaan_id', 'industri_id');
    }

    public function bandar()
    {
        return $this->belongsTo(Bandar::class, 'bandar_id');
    }

    public function negeri()
    {
        return $this->belongsTo(Negeri::class, 'negeri_id');
    }

    public function produkServis()
    {
        return $this->hasMany(ProdukServis::class, 'perniagaan_id');
    }
}