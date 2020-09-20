<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\Billing\Entities\Billing;
use App\Jobs\SendReminderEmail;
use Carbon\Carbon;

class ReminderBilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email to user when the billing almost expried ( 10 minutes )';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->addMinutes(10);
        $billing = Billing::with('product')
                   ->where([['due_date', '<', $now],
                            ['status', 'PENDING']])->get();

        if(!$billing->isEmpty()){
            foreach($billing as $b) SendReminderEmail::dispatch($b->toArray());
        }
        
    }
}