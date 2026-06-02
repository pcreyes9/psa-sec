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
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            $table->string('employee_code')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();

            $table->string('phone_number')->nullable();

            $table->string('department')->nullable();
            $table->string('position');

            $table->decimal('monthly_salary', 10, 2);

            $table->date('hiring_date');

            $table->string('sss_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('pagibig_no')->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Resigned', 'Terminated'])
                ->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
