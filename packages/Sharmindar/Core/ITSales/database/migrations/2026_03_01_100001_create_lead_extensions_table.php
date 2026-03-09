<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('lead_extensions', function (Blueprint $table) {
            $table->unsignedInteger('lead_id')->primary();
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();

            $table->enum('service_type', [
                'web', 'app', 'seo', 'cybersecurity', 'other',
            ])->nullable();

            $table->enum('project_type', [
                'new', 'redesign', 'maintenance',
            ])->nullable();

            $table->string('budget_range', 100)->nullable();
            $table->date('expected_start_date')->nullable();
            $table->string('timeline_expectation', 100)->nullable();
            $table->json('technology_preference')->nullable();
            $table->string('lead_source_detail', 255)->nullable();
            $table->text('requirement_summary')->nullable();
            $table->string('decision_maker_name', 255)->nullable();
            $table->string('decision_maker_role', 255)->nullable();

            // Scoring fields
            $table->unsignedTinyInteger('priority_score')->default(0);
            $table->json('score_breakdown')->nullable();
            $table->enum('temperature', ['hot', 'warm', 'cold'])->default('cold');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_extensions');
    }
};
