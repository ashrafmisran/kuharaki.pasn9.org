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
        'logo',
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

    // Logo helper methods
    public function getLogoUrlAttribute()
    {
        if ($this->logo && \Storage::disk('public')->exists('img/logo/' . $this->logo)) {
            return asset('storage/img/logo/' . $this->logo);
        }
        
        // Return default logo
        return asset('storage/img/logo/default-logo.jpg');
    }

    public function hasLogo()
    {
        return $this->logo && \Storage::disk('public')->exists('img/logo/' . $this->logo);
    }

    // Accessors for template compatibility
    public function getTelefonAttribute()
    {
        return $this->no_telefon;
    }

    public function getAlamatAttribute()
    {
        $alamat = [];
        if ($this->alamat_baris_1) $alamat[] = $this->alamat_baris_1;
        if ($this->alamat_baris_2) $alamat[] = $this->alamat_baris_2;
        if ($this->poskod) $alamat[] = $this->poskod;
        return implode(', ', $alamat);
    }
}