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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique(); // رقم الوصل
            $table->foreignId('student_id')->nullable()->constrained()->onDelete('set null'); // حذف الدفع مع الطالب
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null'); // حذف الدفع مع القسم
            $table->decimal('amount', 10, 2);
            $table->enum('currency', ['IQD', 'USD']);
            $table->date('payment_date');
            $table->text('notes')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete(); // مهم
            $table->foreignId('editor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
