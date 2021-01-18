<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPayment;
use App\DataTables\Admin\Report\FeedbackDataTable;
use App\DataTables\Admin\Report\AdvertPaymentDataTable;

class ReportController extends Controller
{
    public function adverts(AdvertPaymentDataTable $table)
    {
        return $table->render('admin.report.index', [
            "page" => (object) [
                'title' => "Advertisements Report", 'section' => 'Advertisements Report'
            ],
        ]);
    }


    /**
     * Subscription payments report
     *
     * @param Request $request
     * @return mixed
     */
    public function subscriptionPayments(Request $request)
    {
        if (request()->method() == "POST") {
            $model = SubscriptionPayment::query();

            $start_date = request()->get('start_date');
            $end_date = request()->get('end_date');
            if (!empty(request()->get('plan'))) {
                $model = $model->whereHas('subscription.plan', function ($row) {
                    $row->where('id', request()->get('plan'));
                });
            }

            if (!empty($start_date) && !empty($end_date)) {
                $model = $model->whereBetween('payment_date', [
                    Carbon::parse($start_date)->toDateString(),
                    Carbon::parse($end_date)->toDateString()
                ]);
            }
            if (!empty($start_date) && empty($end_date)) {
                $model = $model->where(
                    'payment_date',
                    '>=',
                    Carbon::parse($start_date)->toDateString()
                );
            }
            if (empty($start_date) && !empty($end_date)) {
                $model = $model->where(
                    'payment_date',
                    '<=',
                    Carbon::parse($end_date)->toDateString()
                );
            }

            $model = $model->orderBy('updated_at', 'desc')
                ->with(['subscription.plan']);

            return view('admin.report.subscription_payment.report', [
                "page" => (object) [
                    'title' => "Subscription Payments Report", 'section' => 'Subscription Payments Report',
                ],
                'total' => $model->sum('amount'),
                'data' => $model->get(),
            ]);
        }
        return view('admin.report.subscription_payment.index', [
            "page" => (object) [
                'title' => "Subscription Payments Report", 'section' => 'Subscription Payments Report',
            ],
            'plans' => SubscriptionPlan::all(),
        ]);
    }

    /**
     * feedback report
     *
     * @param FeedbackDataTable $table
     * @return mixed
     */
    public function feedback(FeedbackDataTable $table)
    {
        return $table->render('admin.report.feedback', [
            "page" => (object) [
                'title' => "Feedback Report",
                'section' => 'Feedback Report',
            ],
        ]);
    }
}
