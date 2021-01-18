<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SubscriptionController;
use App\Models\MobileMoneyTransaction;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionRenewalPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!isset($user->subscription)) {
            $subscription = $user->subscription->create([
                'status' => 'owing',
                'user_id' => $user->id,
            ]);

            $user->update(['subscription_id' => $subscription->id]);
        }

        $plans = SubscriptionPlan::orderBy('price')->get();
        return view('subscription.plan.index', [
            "page" => (object) [
                'title' => "Subscription Setup", 'section' => 'Subscription Setup'
            ],
            'plans' => $plans,
            'promotionUrl' => $this->generatePromotionUrl(),
            'renewal_periods' => SubscriptionRenewalPeriod::orderBy('months')->get()
        ]);
    }

    /**
     * Subscribes the user to a plan and also initiate mobile money payment
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function subscribe(Request $request)
    {
        $user = auth()->user();
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'momo_number' => 'required|string|max:20',
                'plan_id' => 'required|exists:subscription_plans,id_hash',
                'renewal_id' => 'required|exists:subscription_renewal_periods,id'
            ]);
            $inputs = $request->all();

            $plan = SubscriptionPlan::findByIdHash($inputs['plan_id']);
            $previous_plan = @$user->subscription->plan_id;
            $subscription = null;
            if (@$user->subscription->is_first_time) {
                $user->subscription->update([
                    'plan_id' => $plan->id,
                    'previous_plan_id' => $previous_plan,
                    'status' => 'owing',
                    'is_active' => false,
                    'renewal_id' => $inputs['renewal_id']
                ]);
                $subscription = $user->subscription;
            } else {
                $subscription = $user->subscriptions()->create([
                    'plan_id' => $plan->id,
                    'previous_plan_id' => $previous_plan,
                    'status' => 'owing',
                    'is_active' => false,
                    'renewal_id' => $inputs['renewal_id']
                ]);
            }
            $inputs['business_id'] = session('business_id');
            $renewalPeriod = SubscriptionRenewalPeriod::find($inputs['renewal_id']);
            $amount = $plan->price * $renewalPeriod->months;

            $momo = MobileMoneyTransaction::create([
                "phone_number" => $inputs['momo_number'],
                "amount" => $amount,
                'subscription_id' => $subscription->id,
                'business_id' => session('business_id'),
                "vendor" => "MTN",
                "message" => "MTN Business Manager subscription payment",
            ]);
//            SubscriptionController::initiatePayment($momo);

            auth()->user()->log("initiated subscription payment" . $this->business()->name);

            $url = "<a href='" . route('subscription.payment.index') . "'>Refresh page</a>";
            Session::flash('alert-success', "Kindly wait for the payment prompt in order to approve payment for the subscription package selected. $url after payment is made to confirm status of payment.");
            return redirect()->route('subscription.payment.index');
        }

        $plans = SubscriptionPlan::all();
        return view('subscription.plan.index', [
            "page" => (object) [
                'title' => "Subscription Setup", 'section' => 'Subscription Setup'
            ],
            'plans' => $plans,
            'promotionUrl' => $this->generatePromotionUrl(),
            'renewal_periods' => SubscriptionRenewalPeriod::orderBy('months')->get()
        ]);
    }

    /**
     * Gives the user 30 days free subscription to the selected plan
     * This code is promotion is available to new users ONLY for AUGUST, 2020.
     *
     * Modify this function & its corresponding route for any given promotion in the future
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function promotion(Request $request)
    {
        $user = auth()->user();

        $plan = SubscriptionPlan::findByIdHash($request->query('plan'));
        if ($plan == null) {
            abort(404);
        }

        if (@$user->subscription->is_first_time) {
            // Give user 1 month subscription => August Promotion
            if (now()->year == 2020 && in_array(now()->month,[7,8,9])) {
                $user->subscription->update([
                    'plan_id' => $plan->id,
                    'status' => 'paid',
                    'is_active' => true,
                    'expiry_date' => now()->endOfMonth(),
                    'last_payment_date' => now(),
                    'is_first_time' => false
                ]);

                $user->log("Subscribed user to august promotion" . $this->business()->name);
                Session::flash('alert-success', "Congratulations!, You have been given 30 Days Free Subscription to our " . $plan->name);
                return redirect()->back();
            }
        }

        abort(404);
    }

    /**
     * Generates a promotion url
     * Updated for any given promotion in the future
     */
    private function generatePromotionUrl()
    {
        if (now()->year == 2020 && in_array(now()->month,[7,8,9])) {
            if (@auth()->user()->subscription->is_first_time) {
                return route('subscription.plan.promotion');
            }
        }
        return null;
    }


    /**
     * Activates the selected subscription plan.
     * The user is then redirected to 'subscription.payment.index' route
     * to make the payment
     *
     * @param $planId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function activatePlan($planId)
    {
        $plan = SubscriptionPlan::findByIdHash($planId);
        if (!isset($plan)) {
            return abort(404);
        }
        $user = auth()->user();
        $previous_plan = $user->subscription->plan_id;
        $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'previous_plan_id' => $previous_plan,
            'status' => 'owing',
            'is_active' => false
        ]);

        Session::flash('alert-success', 'Congratulations! You have subscribed to ' . $plan->name . ' package. Kindly make your payment to activate the plan.');
        return redirect(route('subscription.payment.index'));
    }
}
