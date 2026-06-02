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
        Schema::create('payrolls', function (Blueprint $table) {

            $table->id();

            $table->string('payroll_code')->unique();

            $table->string('month');
            $table->enum('cutoff', ['1', '2']);

            $table->date('date_from');
            $table->date('date_to');

            $table->decimal('total_amount', 12, 2)->default(0);

            $table->enum('status', [
                'Draft',
                'Processed',
                'Released'
            ])->default('Draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
