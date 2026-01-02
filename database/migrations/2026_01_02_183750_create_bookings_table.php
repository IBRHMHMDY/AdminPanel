<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // العميل
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete(); // المطعم
            $table->foreignId('table_type_id')->constrained('table_types')->cascadeOnDelete(); // نوع الطاولة المحجوزة
            $table->dateTime('booking_date'); // تاريخ ووقت الحجز
            $table->integer('guests_count'); // عدد الضيوف الفعلي
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // حالة الحجز
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
