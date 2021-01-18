<?php

namespace App\Console\Commands;

use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class IncompleteBusinessInfoNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:incomplete-business-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notification to owners of businesses with incomplete information';

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
        $this->log("======= Sending Incomplete Business Information Reminder ==========");
        $results = Business::where('reg_no', null)->orWhere('tax_no', null)->orWhere('vat_no', null)->get();
        $this->log("Found " . $results->count() . " businesses");

        $results->each(function ($business) {
            if (!empty($business->owner)) {
                $this->log("Sending reminder to business => " . $business->name . " Owner =>" . $business->owner->first_name . " Business Id => " . $business->id);

                $data = ['business' => $business];
                Mail::send("emails.incomplete_business_info", $data, function ($mail) use ($data) {
                    $mail->subject("MTN Business Manager Reminder")
                         ->to($data['business']->owner->email);
                });
            }
        });
        $this->log("======= Incomplete Business Information Reminder Sent ==========");

        return true;
    }

    /**
     * A simple logger for logging mobile money api responses
     *
     * @param string $message
     * @return void
     */
    public function log($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/incomplete_business_info_notifications.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
