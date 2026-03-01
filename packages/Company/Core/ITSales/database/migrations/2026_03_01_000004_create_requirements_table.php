<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->nullOnDelete();
            $table->foreignId('proposal_id')->nullable()->constrained('proposals')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', [
                'functional', 'non_functional', 'technical',
                'business', 'integration',
            ])->default('functional');
            $table->enum('priority', [
                'must_have', 'should_have', 'nice_to_have',
            ])->default('should_have');
            $table->enum('complexity', [
                'low', 'medium', 'high', 'very_high',
            ])->default('medium');
            $table->enum('status', [
                'gathered', 'analyzed', 'approved', 'deferred', 'rejected',
            ])->default('gathered');
            $table->decimal('estimated_hours', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
