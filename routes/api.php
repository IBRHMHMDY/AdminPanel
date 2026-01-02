<?php

// روابط عامة (لا تحتاج تسجيل دخول)
Route::post('/login', [AuthController::class, 'login']);
Route::get('/restaurants', [RestaurantController.php, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::php, 'show']);

// روابط محمية (تحتاج توكن Token)
Route::middleware('auth:sanctum')->group(function () {
    // إنشاء حجز جديد
    Route::post('/bookings', [BookingController::class, 'store']);

    // عرض حجوزات العميل
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
