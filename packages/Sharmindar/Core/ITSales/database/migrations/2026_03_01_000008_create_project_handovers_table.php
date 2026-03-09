<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('project_handovers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->foreignId('proposal_id')->constrained('proposals');
            $table->foreignId('project_id')->constrained('projects');
            $table->enum('handover_status', [
                'pending', 'in_progress', 'completed',
            ])->default('pending');
            $table->text('handover_notes')->nullable();
            $table->unsignedInteger('handed_over_by');
            $table->foreign('handed_over_by')->references('id')->on('users');
            $table->unsignedInteger('received_by')->nullable();
            $table->foreign('received_by')->references('id')->on('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_handovers');
    }
};
