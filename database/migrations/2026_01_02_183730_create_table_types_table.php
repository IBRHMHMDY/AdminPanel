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
        Schema::create('table_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete(); // ربط بالمطعم
            $table->string('name'); // مثلا: طاولة عائلية، طاولة لشخصين
            $table->integer('capacity'); // سعة الكراسي (مثلا 4)
            $table->integer('quantity'); // كم طاولة من هذا النوع نملك؟ (مثلا 5)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_types');
    }
};
