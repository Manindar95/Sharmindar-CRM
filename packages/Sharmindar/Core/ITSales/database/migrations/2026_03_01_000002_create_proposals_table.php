<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('proposal_number')->unique();
            $table->unsignedInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->nullOnDelete();
            $table->unsignedInteger('quote_id')->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes')->nullOnDelete();
            $table->string('title');
            $table->text('executive_summary')->nullable();
            $table->text('scope_of_work')->nullable();
            $table->json('deliverables')->nullable();
            $table->integer('timeline_weeks')->nullable();
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->date('valid_until')->nullable();
            $table->enum('status', [
                'draft', 'internal_review', 'sent_to_client',
                'client_reviewing', 'revision_requested',
                'accepted', 'rejected', 'expired',
            ])->default('draft');
            $table->integer('version')->default(1);
            $table->foreignId('parent_id')->nullable()->constrained('proposals')->nullOnDelete();
            $table->unsignedInteger('prepared_by');
            $table->foreign('prepared_by')->references('id')->on('users');
            $table->unsignedInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
