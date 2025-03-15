<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name_ar');
            $table->string('first_name_en');
            $table->string('father_name_ar');
            $table->string('father_name_en');
            $table->string('grandfather_name_ar');
            $table->string('grandfather_name_en');
            $table->string('last_name_ar');
            $table->string('last_name_en');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->enum('study_type', ['msc', 'phd']);
            $table->enum('admission_channel', ['private', 'public']);
            $table->enum('academic_stage', ['preparatory', 'research']);
            $table->enum('status', ['active', 'suspended', 'pending_review']);
            $table->text('notes')->nullable();
            $table->date('start_date');
            $table->date('study_end_date')->nullable();
            $table->integer('remaining_study_days')->nullable();
            $table->date('first_extension_date')->nullable(); // التمديد الأول
            $table->date('second_extension_date')->nullable(); // التمديد الثاني
            $table->foreignId('department_id')->constrained(); // ربط بالقسم
            $table->foreignId('author_id')->nullable()->constrained('users'); // ربط بالمؤلف
            $table->foreignId('editor_id')->nullable()->constrained('users'); // ربط بالمحرر
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
