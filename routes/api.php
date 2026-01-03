<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;

// روابط عامة (لا تحتاج تسجيل دخول)
Route::post('admin/login', [AuthController::class, 'login']);
Route::get('admin/restaurants', [RestaurantController::class, 'index']);
Route::get('admin/restaurants/{id}', [RestaurantController::class, 'show']);

// روابط محمية (تحتاج توكن Token)
Route::middleware('auth:sanctum')->group(function () {
    // إنشاء حجز جديد
    Route::post('/bookings', [BookingController::class, 'store']);

    // عرض حجوزات العميل
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
