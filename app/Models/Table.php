<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['event_id', 'name', 'capacity'];

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'table_assignments');
    }
}
