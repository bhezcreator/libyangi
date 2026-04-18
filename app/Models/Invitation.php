<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'guest_id',
        'sent_at',
        'channel',
        'status',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
