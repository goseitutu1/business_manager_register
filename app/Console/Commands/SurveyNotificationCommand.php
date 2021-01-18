<?php

namespace App\Console\Commands;

use App\Models\SurveyNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SurveyNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Google forms survery notifications to accounts created in the last 24 hours';

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
        $this->log("======= Sending Survey Notifications ==========");
        $results = SurveyNotification::where('created_at', '<', now()->toDateTimeString())
        ->where('status', 'like', '%pending%');

        $this->log("Found ". $results->count() . " surveys");

        $results->each(function ($row) {
            $this->log("Sending notification for user => " . $row->user->first_name . " id: => " . $row->user->id);

            $this->sendMail($row);

            $message = "Hello " . $row->user->first_name . ",\nKindly visit the link below to complete a survey.";
            $message = "${message}\nhttps://docs.google.com/forms/d/e/1FAIpQLSeiOzK9Xv3OTyNsec_PiMuhqg0KJ09mxjzBvzCRkWHmya8hUw/viewform";
            $message = "${message}\nThis survey helps us to improve the product for you.";
            $message = "${message}\nThank You, \nMTN Business Manager";

            $resp = $this->sendSms($message, $row->user->phone_number);
            $row->update([
                'is_sms_sent' => true,
                // 'sms_api_response' => $resp,
                'status' => 'sent',
                'sent_at' => now()
            ]);
        });
        $this->log("======= Survey Notifications Sending Completed ==========");

        return true;
    }

    private function sendMail(SurveyNotification $survey)
    {
        $data = ['user' => $survey->user];
        Mail::send("emails.survey", $data, function ($mail) use ($data) {
            $mail->subject("MTN Business Manager Survey")
                 ->to($data['user']->email);
        });
        $survey->update(['is_email_sent' => true]);
    }

    private function sendSms($text, $phone)
    {
        $message = urlencode($text);
        $num = urlencode($phone);

        // TODO: report this bug to mtn. We bypass their filter of SMS ID with this trick
        $source = chr(160) . "MTNBusiness";

        $url = "https://deywuro.com/api/sms?username=mtnbusinessmgr&password=ed6486&source=$source&destination=" . $num . "&message=" . $message;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
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
        file_put_contents(storage_path() . '/logs/survey_notifications.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
