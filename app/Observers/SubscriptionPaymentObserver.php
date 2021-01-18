<?php

namespace App\Observers;

use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\Mail;

class SubscriptionPaymentObserver
{
    /**
     * Handle the subscription payment "created" event.
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    public function created(SubscriptionPayment $subscriptionPayment)
    {
        $data = ['payment' => $subscriptionPayment, 'user' => $subscriptionPayment->user];
        Mail::send("emails.subscription_payment", $data, function ($mail) use ($data) {
            $mail->subject("MTN Business Manager - Subscription Payment")
                 ->to($data['user']->email);
        });
    }

    /**
     * Handle the subscription payment "updated" event.
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    public function updated(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the subscription payment "deleted" event.
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    public function deleted(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the subscription payment "restored" event.
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    public function restored(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the subscription payment "force deleted" event.
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    public function forceDeleted(SubscriptionPayment $subscriptionPayment)
    {
        //
    }
}
