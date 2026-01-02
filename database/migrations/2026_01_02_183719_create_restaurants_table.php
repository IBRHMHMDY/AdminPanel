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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم المطعم
            $table->text('address')->nullable(); // العنوان
            $table->string('phone')->nullable();
            $table->string('image')->nullable(); // صورة المطعم
            $table->time('open_at')->default('09:00:00'); // ساعة الفتح
            $table->time('close_at')->default('23:00:00'); // ساعة الإغلاق
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
