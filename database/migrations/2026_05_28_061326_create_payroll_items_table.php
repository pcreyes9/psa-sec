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
        Schema::create('payroll_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('payroll_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('payroll_code');

            $table->string('month');
            $table->tinyInteger('cutoff');

            // $table->integer('days_present')->default(0);

            // $table->decimal('regular_hours', 8, 2)->default(0);
            // $table->decimal('overtime_hours', 8, 2)->default(0);

            $table->decimal('daily_rate', 12, 2)->default(0);
            $table->decimal('hourly_rate', 12, 2)->default(0);

            $table->decimal('basic_pay', 12, 2)->default(0);
            $table->decimal('overtime_pay', 12, 2)->default(0);

            $table->decimal('allowances', 12, 2)->default(0);

            $table->decimal('late_deduction', 12, 2)->default(0);
            $table->decimal('other_deductions', 12, 2)->default(0);
            $table->decimal('tax_deduction', 12, 2)->default(0);

            $table->decimal('gross_pay', 12, 2)->default(0);
            $table->decimal('net_pay', 12, 2)->default(0);

            $table->enum('status', [
                'Draft',
                'Finalized',
                'Paid'
            ])->default('Draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
    }
};
