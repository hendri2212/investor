<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'capital',
    ];

    // Relasi ke model User, jika ada
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}