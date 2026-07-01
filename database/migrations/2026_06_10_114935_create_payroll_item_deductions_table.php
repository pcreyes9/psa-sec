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
        Schema::create('payroll_item_deductions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('payroll_item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('deduction_name');

            $table->string('deduction_type')
                ->nullable();

            $table->decimal('amount', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_item_deductions');
    }
};
