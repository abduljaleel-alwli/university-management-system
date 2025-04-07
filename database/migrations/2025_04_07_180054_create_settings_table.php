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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('University System');
            $table->string('site_logo')->nullable(); // رابط الصورة
            $table->string('favicon')->nullable(); // رابط الأيقونة المفضلة للموقع
            $table->string('primary_color')->default('#f9bee8');
            $table->string('secondary_color')->default('#b4d0fd');
            $table->string('accent_color')->default('#f9bee8');
            $table->string('background_color')->default('#b4d0fd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
