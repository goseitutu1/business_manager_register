<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\User;
use App\Models\SubscriptionPayment;
use App\Models\Feedback;

class DashboardController extends Controller
{

    /**
     * Index page
     */
    public function index()
    {
        $subscription_payments = SubscriptionPayment::where('payment_date', today()->toDateString())
            ->sum('amount');
        $pending_feedback = Feedback::where('status', 'like', '%pending%')->count();

        return view('admin.layout.dashboard', [
            "page" => (object) [
                'title' => "Businesses", 'section' => 'Business | Create'
            ],
            "users" => User::count(),
            'ads' => Advert::count(),
            'subscription_payments' => $subscription_payments,
            'pending_feedback' => $pending_feedback,
        ]);
    }
}
