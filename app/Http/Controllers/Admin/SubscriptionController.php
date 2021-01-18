<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\Subscription\PaymentHistoryDataTable;
use App\DataTables\Admin\Subscription\PaymentsDataTable;
use App\DataTables\Admin\Subscription\SubscriptionPlanDataTable;
use App\DataTables\Admin\Subscription\UserSubscriptionDataTable;
use App\Http\Controllers\Admin\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function plans(SubscriptionPlanDataTable $table)
    {
        $plans =  SubscriptionPlan::all();
        return $table->render('admin.subscription.index', [
            "page" => (object) [
                'title' => "Subscription Setup", 'section' => 'Subscription Setup'
            ],
            'plans' => $plans,
        ]);
    }

    public function userSubscriptions(UserSubscriptionDataTable $table)
    {
        return $table->render('admin.subscription.index', [
            "page" => (object) [
                'title' => "User Subscriptions", 'section' => 'Subscriptions'
            ],
        ]);
    }

    public function paymentHistory(PaymentHistoryDataTable $table)
    {
        return $table->render('admin.subscription.index', [
            "page" => (object) [
                'title' => "Subscription Payments", 'section' => 'Payments History'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $plan =  SubscriptionPlan::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('subscription_plans')
                        ->ignore($plan),
                ],
                'minimum_employees' => 'numeric|min:0|lte:maximum_employees',
                'maximum_employees' => 'numeric|gte:minimum_employees',
                'price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                '' => 'boolean',
                'description' => 'nullable|string|max:255',
            ]);
            $inputs = $request->all();
            $val = $inputs['has_employees_limit'] ?? false;
            $inputs['has_employees_limit'] = ($val == "true" || $val == true);
            $plan->update($inputs);
            auth()->user()->log("updated subscription plan: " . $plan->id);

            Session::flash('alert-success', 'Subscription Updated Successfully');
            return redirect()->route('admin.subscription.plan.index');
        }
        return view('admin.subscription.edit', [
            "page" => (object) [
                'title' => "Edit Subscription", 'section' => 'Edit Subscription'
            ],
            'data' => $plan,
        ]);
    }
}
