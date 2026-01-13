<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;

// روابط عامة (لا تحتاج توكن Token)
// Route::post('/register', [AuthController::class, 'register']); // تسجيل مستخدم
Route::post('/login', [AuthController::class, 'login']);    //  تسجيل الدخول المستخدم
// Route::get('/restaurants', [RestaurantController::class, 'index']); // عرض جميع المطاعم
// Route::get('/restaurants/{id}', [RestaurantController::class, 'show']); // عرض تفاصيل مطعم معين

// روابط محمية للمستخدم العادي (تحتاج توكن Token وصلاحيات مستخدم)
Route::middleware(['auth:sanctum', 'is_user'])->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index']); // عرض جميع المطاعم
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show']); // عرض تفاصيل مطعم معين
    Route::post('/bookings', [BookingController::class, 'store']); // إنشاء حجز جديد
    Route::get('/my-bookings', [BookingController::class, 'myBookings']); // عرض جميع حجوزات المستخدم
    // Route::get('/my-bookings/{id}', [BookingController::class, 'show']); // عرض تفاصيل حجز معين
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel']); // إلغاء حجز محدد
    Route::post('/logout', [AuthController::class, 'logout']); // تسجيل خروج المستخدم
    // مفضلة المطاعم
    Route::post('/restaurants/{restaurant}/favorite/toggle', [RestaurantController::class, 'toggleFavorite']);
    // Route::get('/my-favorites', [FavoriteController::class, 'index']);
});
