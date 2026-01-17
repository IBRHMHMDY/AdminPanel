<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Restaurant extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'address', 'phone', 'image', 'open_at', 'close_at', 'user_id'];

    // أضف هذا السطر لكي يتم إرسال الحقل دائماً مع الـ JSON
    protected $appends = ['is_favorited'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // الموظفين التابعين للمطعم
    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }

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

    public function getIsFavoritedAttribute()
    {
        // إذا لم يكن هناك مستخدم مسجل دخول، عد بـ false
        if (! auth('sanctum')->check()) {
            return false;
        }

        // تحقق مما إذا كان المطعم موجوداً في مفضلة المستخدم الحالي
        return auth('sanctum')->user()->favorites()->where('restaurant_id', $this->id)->exists();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // أضف هذا التابع داخل الكلاس
    protected function getImageAttribute($value)
    {
        if (! $value) {
            return null;
        }

        // إذا كان الاسم يبدأ بـ http فهذا يعني أنه رابط خارجي بالفعل
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // وإلا، قم بدمج رابط السيرفر مع مسار المجلد الذي ترفع فيه الصور
        // مثال: http://192.168.1.5:8000/storage/restaurants/image1.jpg
        return asset('storage/'.$value);
    }
}
