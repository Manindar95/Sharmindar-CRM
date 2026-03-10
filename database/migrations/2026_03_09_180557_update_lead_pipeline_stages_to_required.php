<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $pipelineId = 1;

        $requiredStages = [
            ['code' => 'new', 'name' => 'New Lead'],
            ['code' => 'contacted', 'name' => 'Contacted'],
            ['code' => 'requirement-gathering', 'name' => 'Requirement Gathering'],
            ['code' => 'qualified', 'name' => 'Qualified'],
            ['code' => 'proposal-preparation', 'name' => 'Proposal Preparation'],
            ['code' => 'proposal-sent', 'name' => 'Proposal Sent'],
            ['code' => 'negotiation', 'name' => 'Negotiation'],
            ['code' => 'won', 'name' => 'Won'],
            ['code' => 'lost', 'name' => 'Lost'],
            ['code' => 'on-hold', 'name' => 'On Hold'],
        ];

        $newStage = DB::table('lead_pipeline_stages')->where('code', 'new')->where('lead_pipeline_id', $pipelineId)->first();
        if (!$newStage) {
            $newStageId = DB::table('lead_pipeline_stages')->insertGetId([
                'code' => 'new',
                'name' => 'New Lead',
                'lead_pipeline_id' => $pipelineId,
                'sort_order' => 1,
            ]);
        }
        else {
            $newStageId = $newStage->id;
        }

        $validCodes = array_column($requiredStages, 'code');

        $stagesToDelete = DB::table('lead_pipeline_stages')
            ->where('lead_pipeline_id', $pipelineId)
            ->whereNotIn('code', $validCodes)
            ->pluck('id');

        if ($stagesToDelete->count() > 0) {
            DB::table('leads')
                ->whereIn('lead_pipeline_stage_id', $stagesToDelete)
                ->update(['lead_pipeline_stage_id' => $newStageId]);

            DB::table('lead_pipeline_stages')
                ->whereIn('id', $stagesToDelete)
                ->delete();
        }

        foreach ($requiredStages as $index => $stageData) {
            $existing = DB::table('lead_pipeline_stages')
                ->where('lead_pipeline_id', $pipelineId)
                ->where('code', $stageData['code'])
                ->first();

            if ($existing) {
                DB::table('lead_pipeline_stages')
                    ->where('id', $existing->id)
                    ->update([
                    'name' => $stageData['name'],
                    'sort_order' => $index + 1,
                ]);
            }
            else {
                DB::table('lead_pipeline_stages')->insert([
                    'code' => $stageData['code'],
                    'name' => $stageData['name'],
                    'lead_pipeline_id' => $pipelineId,
                    'sort_order' => $index + 1,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    // Reverting is not officially supported as it causes data loss.
    }
};
