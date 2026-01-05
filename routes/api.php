<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;

// روابط عامة (لا تحتاج توكن Token)
// Route::post('/register', [AuthController::class, 'register']); // تسجيل مستخدم
Route::post('/login', [AuthController::class, 'login']);    //  تسجيل الدخول المستخدم
Route::get('/restaurants', [RestaurantController::class, 'index']); // عرض جميع المطاعم
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']); // عرض تفاصيل مطعم معين

// روابط محمية للمستخدم العادي (تحتاج توكن Token وصلاحيات مستخدم)
Route::middleware(['auth:sanctum', 'is_user'])->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']); // إنشاء حجز جديد
    Route::get('/my-bookings', [BookingController::class, 'myBookings']); // عرض جميع حجوزات المستخدم
    // Route::get('/my-bookings/{id}', [BookingController::class, 'show']); // عرض تفاصيل حجز معين
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel']); // إلغاء حجز محدد
    // تسجيل خروج المستخدم
    // Route::post('/logout', [AuthController::class, 'logout']);
});
// روابط محمية للمسؤول (تحتاج توكن Token وصلاحيات مسؤول)
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/admin/bookings', [BookingController::class, 'store']); // إنشاء حجز جديد
    Route::get('/admin/my-bookings', [BookingController::class, 'myBookings']); // عرض جميع حجوزات المستخدم
    // Route::get('/admin/my-bookings/{id}', [BookingController::class, 'show']); // عرض تفاصيل حجز معين
    Route::post('/admin/bookings/{id}/cancel', [BookingController::class, 'cancel']); // إلغاء حجز محدد
    // Route::post('/logout', [AuthController::class, 'logout']); // تسجيل خروج المستخدم
});
