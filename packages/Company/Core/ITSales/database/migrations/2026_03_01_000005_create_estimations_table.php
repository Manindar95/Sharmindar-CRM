<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained('proposals')->cascadeOnDelete();
            $table->unsignedInteger('estimated_by');
            $table->foreign('estimated_by')->references('id')->on('users');
            $table->decimal('total_hours', 10, 2)->default(0);
            $table->decimal('buffer_percentage', 5, 2)->default(20);
            $table->decimal('total_with_buffer', 10, 2)->default(0);
            $table->decimal('total_cost', 14, 2)->default(0);
            $table->text('assumptions')->nullable();
            $table->text('risks')->nullable();
            $table->enum('status', ['draft', 'reviewed', 'approved'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimations');
    }
};
