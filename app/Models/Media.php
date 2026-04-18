<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'event_id',
        'file',
        'type',
        'visibility',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
