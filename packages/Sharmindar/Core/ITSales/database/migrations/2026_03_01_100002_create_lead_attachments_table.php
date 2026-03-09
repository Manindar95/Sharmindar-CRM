<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('lead_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->string('file_name');
            $table->string('file_path');
            $table->enum('file_type', [
                'document', 'design', 'pdf', 'voice_note', 'image', 'other',
            ])->default('document');
            $table->unsignedInteger('file_size')->default(0);
            $table->unsignedInteger('uploaded_by');
            $table->foreign('uploaded_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_attachments');
    }
};
