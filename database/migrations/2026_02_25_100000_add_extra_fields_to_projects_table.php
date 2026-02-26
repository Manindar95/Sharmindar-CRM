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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedInteger('client_id')->nullable()->after('description');
            $table->string('project_type')->nullable()->after('client_id');
            $table->date('expected_end_date')->nullable()->after('end_date');
            $table->date('actual_end_date')->nullable()->after('expected_end_date');
            $table->unsignedInteger('manager_id')->nullable()->after('actual_end_date');
            $table->unsignedInteger('owner_id')->nullable()->after('manager_id');
            $table->string('priority')->nullable()->after('owner_id');
            $table->string('team_type')->nullable()->after('priority');

            $table->foreign('client_id')->references('id')->on('persons')->onDelete('set null');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['manager_id']);
            $table->dropForeign(['owner_id']);
            
            $table->dropColumn([
                'client_id',
                'project_type',
                'expected_end_date',
                'actual_end_date',
                'manager_id',
                'owner_id',
                'priority',
                'team_type',
            ]);
        });
    }
};
