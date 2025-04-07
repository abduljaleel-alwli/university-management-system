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
        Schema::create('post_graduation_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->date('discussion_date')->nullable(); // موعد المناقشة
            $table->string('committee_decision')->nullable(); // قرار اللجنة
            $table->boolean('clearance')->default(false); // براءة الذمة
            $table->boolean('sent_to_college')->default(false); // إرسال إلى مجلس الكلية
            $table->boolean('sent_to_ministry')->default(false); // إرسال إلى الوزارة
            $table->boolean('archived')->default(false); // الأرشفة
            $table->enum('post_graduation_status', ['graduate', 'fail', 'pending_review'])->default('pending_review'); // حالة الطالب بعد التخرج
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_graduation_steps');
    }
};
