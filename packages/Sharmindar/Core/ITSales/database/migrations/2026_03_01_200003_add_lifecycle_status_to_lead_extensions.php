<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::table('lead_extensions', function (Blueprint $table) {
            $table->foreignId('lifecycle_status_id')
                ->nullable()
                ->after('lead_id')
                ->constrained('lead_lifecycle_statuses')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('lead_extensions', function (Blueprint $table) {
            $table->dropForeign(['lifecycle_status_id']);
            $table->dropColumn('lifecycle_status_id');
        });
    }
};
