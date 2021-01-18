<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class BusinessSelected
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = session('business_id');
        if (!empty($id)) {
            $business = Business::find($id);
            View::share('selected_business', $business);
        } else {
            Session::flash('alert-danger', 'You have to setup a business to continue');
            return redirect(route('business.create_from_signup'));
        }
        return $next($request);
    }
}
