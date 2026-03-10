<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Sharmindar\Core\Lead\Models\Lead;
use App\Notifications\LeadInactivityNotification;
use Illuminate\Support\Carbon;

class LeadInactivityReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:inactivity-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for leads with no activity in 10 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limitDate = Carbon::now()->subDays(10);

        // Find leads updated more than 10 days ago that are neither won nor lost
        $leads = Lead::where('updated_at', '<=', $limitDate)
            ->whereHas('stage', function ($query) {
            $query->whereNotIn('code', ['won', 'lost']);
        })
            ->get();

        $count = 0;
        foreach ($leads as $lead) {
            if ($lead->user) {
                $lead->user->notify(new LeadInactivityNotification($lead));
                $count++;
            }
        }

        $this->info("Sent {$count} inactivity reminders.");
    }
}
