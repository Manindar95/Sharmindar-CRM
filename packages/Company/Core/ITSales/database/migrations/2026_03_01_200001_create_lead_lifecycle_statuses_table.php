<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('lead_lifecycle_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('color', 7)->default('#6B7280');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_terminal')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Seed default IT workflow statuses
        $statuses = [
            ['name' => 'New Lead', 'code' => 'new_lead', 'color' => '#3B82F6', 'sort_order' => 1, 'is_terminal' => false, 'description' => 'Freshly created or received lead'],
            ['name' => 'Contacted', 'code' => 'contacted', 'color' => '#8B5CF6', 'sort_order' => 2, 'is_terminal' => false, 'description' => 'Initial contact made with the prospect'],
            ['name' => 'Requirement Gathering', 'code' => 'requirement_gathering', 'color' => '#F59E0B', 'sort_order' => 3, 'is_terminal' => false, 'description' => 'Collecting and documenting client requirements'],
            ['name' => 'Qualified', 'code' => 'qualified', 'color' => '#10B981', 'sort_order' => 4, 'is_terminal' => false, 'description' => 'Lead meets qualification criteria'],
            ['name' => 'Proposal Preparation', 'code' => 'proposal_preparation', 'color' => '#6366F1', 'sort_order' => 5, 'is_terminal' => false, 'description' => 'Preparing proposal and estimation'],
            ['name' => 'Proposal Sent', 'code' => 'proposal_sent', 'color' => '#EC4899', 'sort_order' => 6, 'is_terminal' => false, 'description' => 'Proposal delivered to the client'],
            ['name' => 'Negotiation', 'code' => 'negotiation', 'color' => '#F97316', 'sort_order' => 7, 'is_terminal' => false, 'description' => 'In active negotiation on terms and pricing'],
            ['name' => 'Won', 'code' => 'won', 'color' => '#22C55E', 'sort_order' => 8, 'is_terminal' => true, 'description' => 'Deal closed successfully'],
            ['name' => 'Lost', 'code' => 'lost', 'color' => '#EF4444', 'sort_order' => 9, 'is_terminal' => true, 'description' => 'Deal lost or prospect declined'],
            ['name' => 'On Hold', 'code' => 'on_hold', 'color' => '#6B7280', 'sort_order' => 10, 'is_terminal' => false, 'description' => 'Lead paused — client needs time or budget delay'],
        ];

        $now = now();
        foreach ($statuses as $status) {
            DB::table('lead_lifecycle_statuses')->insert(array_merge($status, [
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_lifecycle_statuses');
    }
};
