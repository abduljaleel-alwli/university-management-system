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
            $table->string('receipt_number')->unique(); // رقم الوصل يتم إنشاؤه تلقائيًا
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // ربط بالطالب
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); // المبلغ
            $table->enum('currency', ['IQD', 'USD']); // العملة
            $table->date('payment_date'); // تاريخ الدفع
            $table->text('notes')->nullable(); // الملاحظات
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('editor_id')->nullable()->constrained('users')->onDelete('set null');
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
