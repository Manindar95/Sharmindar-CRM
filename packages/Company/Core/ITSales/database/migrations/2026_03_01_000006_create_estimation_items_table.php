<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('estimation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimation_id')->constrained('estimations')->cascadeOnDelete();
            $table->foreignId('requirement_id')->nullable()->constrained('requirements')->nullOnDelete();
            $table->string('task_description');
            $table->enum('phase', [
                'discovery', 'design', 'development', 'testing', 'deployment',
            ])->default('development');
            $table->string('role')->default('Developer');
            $table->decimal('hours', 10, 2)->default(0);
            $table->decimal('rate', 12, 2)->default(0);
            $table->decimal('cost', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimation_items');
    }
};
