<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('lead_status_transitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->foreignId('from_status_id')->nullable()->constrained('lead_lifecycle_statuses')->nullOnDelete();
            $table->foreignId('to_status_id')->constrained('lead_lifecycle_statuses');
            $table->unsignedInteger('transitioned_by');
            $table->foreign('transitioned_by')->references('id')->on('users');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_status_transitions');
    }
};
