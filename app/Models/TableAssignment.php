<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableAssignment extends Model
{
    protected $fillable = [
        'guest_id',
        'table_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
