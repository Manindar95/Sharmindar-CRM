<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->morphs('approvable');
            $table->integer('stage')->default(1);
            $table->string('stage_name');
            $table->unsignedInteger('approver_id');
            $table->foreign('approver_id')->references('id')->on('users');
            $table->enum('status', [
                'pending', 'approved', 'rejected', 'skipped',
            ])->default('pending');
            $table->text('comments')->nullable();
            $table->timestamp('decided_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
