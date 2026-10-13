<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skema extends Model
{
    protected $fillable = [
        'nama_skema',
        'kode_skema',
        'deskripsi',
    ];

    public function pesertas(): HasMany
    {
        return $this->hasMany(Peserta::class);
    }
}
