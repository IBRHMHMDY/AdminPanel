<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableType extends Model
{
    protected $fillable = ['restaurant_id', 'name', 'capacity', 'quantity'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
