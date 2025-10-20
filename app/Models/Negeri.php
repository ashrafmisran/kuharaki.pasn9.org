<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negeri extends Model
{
    protected $table = 'negeri';

    protected $fillable = [
        'nama',
    ];

    public function bandar()
    {
        return $this->hasMany(Bandar::class, 'negeri_id');
    }

    public function perniagaan()
    {
        return $this->hasMany(Perniagaan::class, 'negeri_id');
    }
}
