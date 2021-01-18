<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpiryAlert;

class SubscriptionExpiryReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expiry-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends subscription expiration reminder via SMS and email. The reminder is sent only on 1 week and 2 days to the date of expiration and on the day of expiry';

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
     * @return mixed
     */
    public function handle()
    {
        logger('executing subscription expiry reminder command');
        $data = Subscription::where('is_active', true)
            ->whereDate('expiry_date', '=', today()->addDays(7))
            ->orWhereDate('expiry_date', '=', today()->addDays(2))
            ->orWhereDate('expiry_date', '=', today()->addDays(28))
            ->orWhereDate('expiry_date', '=', today()->addDays(19))
            ->orWhereDate('expiry_date', '=', today())
            ->get();

        logger($data->count() . ' subscriptions found');
        $data->each(function ($row) {
            logger('sending subscription expiry reminder for subscription ' . $row->id);
            try {
                Mail::to($row->user)->send(new SubscriptionExpiryAlert($row));
            } catch (\Exception $e) {
                logger()->error($e);
            }
        });
        logger('done executing subscription expiry reminder command');
    }
}
