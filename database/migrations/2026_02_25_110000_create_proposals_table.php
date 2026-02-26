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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('proposal_id')->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('user_id'); // Project Owner / BD Owner
            $table->date('proposal_date');
            $table->decimal('value', 12, 4)->default(0);
            $table->string('status')->default('draft');
            
            $table->date('ceo_approved_at')->nullable();
            $table->date('manager_approved_at')->nullable();
            $table->date('shared_with_client_at')->nullable();
            $table->date('client_signed_at')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
