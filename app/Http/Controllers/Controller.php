<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Returns an instance of the active business
     * using 'business_id' session value
     *
     * @return Business
     */
    public function business() : Business
    {
        return Business::find(session('business_id'));
    }

    /**
     * Returns the business owned by the current user
     *
     * @return void
     */
    public function businesses()
    {
        return $this->businessOwner()->businesses();
    }

    /**
     * Returns the owner of the active business
     *
     * @return App\Models\User
     */
    public function businessOwner() : \App\Models\User
    {
        return @$this->business()->owner;
    }

    public function isPostRequest()
    {
        return "POST" == request()->method();
    }

    /**
     * Sends SMS
     * @param $text
     * @param $phone
     * @param string $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSms($text, $phone)
    {
        $message = urlencode($text);
        $num = urlencode($phone);
        // $source = chr(194) . chr(160) ."MTN". chr(194) . chr(160);
        // TODO: report this bug to mtn. We bypass their filter of SMS ID with this trick
        $source = chr(160) ."MTNBusiness";

        $url = "https://deywuro.com/api/sms?username=mtnbusinessmgr&password=ed6486&source=$source&destination=" . $num . "&message=" . $message;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}
