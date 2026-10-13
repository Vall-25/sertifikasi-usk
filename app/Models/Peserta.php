<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $fillable = [
        'user_id',
        'skema_id',
        'nama',
        'nik',
        'email',
        'no_hp',
        'tanggal_lahir',
        'alamat',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class);
    }
}