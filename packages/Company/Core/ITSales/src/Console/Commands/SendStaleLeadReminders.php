<?php

namespace Company\Core\ITSales\Console\Commands;

use Company\Core\ITSales\Models\LeadExtension;
use Company\Core\ITSales\Models\LeadStatusTransition;
use Company\Core\ITSales\Notifications\StaleLeadReminder;
use Illuminate\Console\Command;

class SendStaleLeadReminders extends Command
{
    protected $signature = 'leads:remind-stale {--hours=48 : Hours threshold for stale leads}';

    protected $description = 'Send reminder notifications for leads with no status update beyond the threshold';

    public function handle(): int
    {
        $hours = (int)$this->option('hours');
        $threshold = now()->subHours($hours);

        $this->info("Finding leads stale for > {$hours} hours...");

        $extensions = LeadExtension::with(['lead.user', 'lifecycleStatus'])
            ->whereNotNull('lifecycle_status_id')
            ->whereHas('lifecycleStatus', fn($q) => $q->where('is_terminal', false))
            ->get();

        $reminded = 0;

        foreach ($extensions as $ext) {
            $lastTransition = LeadStatusTransition::where('lead_id', $ext->lead_id)
                ->latest('created_at')
                ->first();

            $lastUpdated = $lastTransition ? $lastTransition->created_at : ($ext->updated_at ?? $ext->created_at);

            if ($lastUpdated && $lastUpdated->lt($threshold)) {
                $lead = $ext->lead;

                if (!$lead || !$lead->user) {
                    continue;
                }

                $hoursStale = (int)$lastUpdated->diffInHours(now());
                $statusName = $ext->lifecycleStatus ? $ext->lifecycleStatus->name : 'Unknown';

                $lead->user->notify(
                    new StaleLeadReminder($lead, $statusName, $hoursStale)
                );

                $reminded++;
                $this->line("  Stale: {$lead->title} - {$hoursStale}hrs in {$statusName}");
            }
        }

        $this->info("Done. Sent {$reminded} reminder(s).");

        return self::SUCCESS;
    }
}
