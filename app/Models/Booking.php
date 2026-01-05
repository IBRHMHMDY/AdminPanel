<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'table_type_id',
        'booking_date',
        'guests_count',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'datetime', // مهم جداً للتعامل مع التواريخ لاحقاً
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function tableType()
    {
        return $this->belongsTo(TableType::class);
    }
}
