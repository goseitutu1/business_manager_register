<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Business;
use Illuminate\Support\Facades\Session;

class IsSubscriptionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $subscription = Business::find(session('business_id'))->owner->subscription;

        if ($subscription != null && !($subscription->expiry_date < today() || $subscription->expiry_date == null)) {
            return $next($request);
        }
        Session::flash('alert-warning', "Your subscription has expired. Kindly renew your subscription");
        return redirect()->route('subscription.payment.index');
    }
}
