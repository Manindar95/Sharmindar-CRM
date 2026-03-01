<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', [
                'development', 'design', 'consulting',
                'maintenance', 'testing', 'devops',
            ])->default('development');
            $table->enum('billing_type', [
                'fixed', 'hourly', 'monthly_retainer',
            ])->default('hourly');
            $table->decimal('hourly_rate', 12, 2)->nullable();
            $table->decimal('fixed_price', 12, 2)->nullable();
            $table->json('technology_stack')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
