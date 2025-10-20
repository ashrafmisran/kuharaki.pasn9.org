<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'industri';

    protected $fillable = [
        'nama',
    ];

    public function perniagaan()
    {
        return $this->belongsToMany(Perniagaan::class, 'industri_perniagaan', 'industri_id', 'perniagaan_id');
    }
}
