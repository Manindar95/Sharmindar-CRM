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
        Schema::dropIfExists('payments');
        
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->unsignedBigInteger('project_id');
            $table->date('invoice_date');
            $table->decimal('invoice_amount', 12, 4)->default(0);
            $table->date('due_date')->nullable();
            $table->string('payment_status')->default('pending');
            $table->date('payment_received_date')->nullable();
            $table->unsignedInteger('followup_owner_id')->nullable();
            
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('followup_owner_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
