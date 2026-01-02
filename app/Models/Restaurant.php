<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'image', 'open_at', 'close_at'];

    // المطعم يملك أنواع طاولات متعددة
    public function tableTypes()
    {
        return $this->hasMany(TableType::class);
    }

    // المطعم لديه حجوزات كثيرة
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
