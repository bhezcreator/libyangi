<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programmes extends Model
{
    protected $fillable = ['event_id', 'titre', 'detail', 'icone', 'date_heure', 'type', 'order'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
