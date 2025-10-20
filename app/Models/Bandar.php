<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bandar extends Model
{
    protected $table = 'bandar';

    protected $fillable = [
        'nama',
        'negeri_id',
    ];

    public function negeri()
    {
        return $this->belongsTo(Negeri::class, 'negeri_id');
    }

    public function perniagaan()
    {
        return $this->hasMany(Perniagaan::class, 'bandar_id');
    }
}
