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
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->unique();
            $table->string('job_title')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedInteger('reporting_manager_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->text('skills')->nullable();
            $table->decimal('experience_years', 8, 2)->default(0);
            $table->enum('salary_type', ['hourly', 'daily', 'weekly', 'monthly'])->default('monthly');
            $table->decimal('salary_amount', 12, 2)->default(0);
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reporting_manager_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};
