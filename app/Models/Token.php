<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'token_type',
        'revoked',
        'expired',
        'expires_at',
        'user_id',
    ];

    protected $casts = [
        'revoked' => 'boolean',
        'expired' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public function scopeActive($query)
    {
        return $query
            ->where('expired', false)
            ->where('revoked', false)
            ->where('expires_at', '>', Carbon::now());
    }
}
