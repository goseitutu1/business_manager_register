<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Sales\Report\DebtorsListTransformer;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @group Reports
 *
 * APIs for managing activities reports
 */
class ReportController extends BaseController
{

    /**
     * Debtors List
     *
     * List of customers with outstanding payments
     *
     * @authenticated
     *
     * @urlParam id required The id of the business.
     *
     * @transformerCollection App\Api\Transformers\v1\Sales\Report\DebtorsListTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function debtorsList($bus_id)
    {
        $bus = Business::findByIdHash($bus_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }

        $results = Customer::where('business_id', $bus->id)
            ->whereHas('payments', function ($payment) {
                $payment->whereColumn('amount_paid', '<', 'total_amount');
                $payment->orWhere('amount_paid', null);
            })->with(['payments'])->get();

        auth()->user()->log("Generated debtors list for business: '{$bus->name}', id: {$bus->id}");
        return $this->response->collection($results, new DebtorsListTransformer());
    }

    /**
     * Sales
     *
     * A summary report of all sales activities
     *
     * @authenticated
     *
     * @urlParam business_id required The id of the business.
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function sales($bus_id)
    {
        $bus = Business::findByIdHash($bus_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }

        $response = [];

        $response['total_sales'] = Sales::where('business_id', $bus->id)->sum('total');

        $now  = Carbon::now()->toDateString();

        $sales = Sales::where('business_id', $bus->id)
            ->whereDate('created_at', $now)
            ->sum('total');

        $expense = Expense::where('business_id', $bus->id)
            ->whereDate('created_at', $now)
            ->sum('total_amount');

        $response['profit_today'] = $sales - $expense;

        auth()->user()->log("Generated sales summary report for business: '{$bus->name}', id: {$bus->id}");
        return ['data' => $response];
    }

    /**
     * Finance
     *
     * Returns a summary report of all financial activities.
     * ie. Total revenue & expenses, total credit & debit, profit and loss, etc.
     *
     * @authenticated
     *
     * @urlParam business_id required The id of the business.
     * @queryParam type Wether 'weekly', 'yearly' or 'monthly' report. Default to weekly if not set.
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function finance($bus_id)
    {
        $bus = Business::findByIdHash($bus_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }
        $type = strtolower(request()->query('type', 'weekly'));
        $date_a = Carbon::now();
        $date_b = Carbon::now();

        if ($type == "yearly")
            $dates = [
                $date_a->startOfYear()->toDateString(),
                $date_b->endOfYear()->toDateString()
            ];
        else if ($type == "monthly")
            $dates = [
                $date_a->startOfMonth()->toDateString(),
                $date_b->endOfMonth()->toDateString()
            ];
        else
            $dates = [
                $date_a->startOfWeek()->toDateString(),
                $date_b->endOfWeek()->toDateString()
            ];

        // calculate total sales
        $revenue = Sales::where('business_id', $bus->id)
            ->whereBetween('created_at', $dates)->sum('total');

        /// calculate total expenses
        $expense = Expense::where('business_id', $bus->id)
            ->whereBetween('created_at', $dates)->sum('total_amount');

        // calculate total credit
        $res = Payment::where('business_id', $bus->id)
            ->whereColumn('amount_paid', '<', 'total_amount')
            ->whereBetween('created_at', $dates);
        $total_credit = $res->sum('total_amount') - $res->sum('amount_paid');

        // calculate total debit
        $res = Expense::where('business_id', $bus->id)
            ->whereColumn('amount_paid', '<', 'total_amount')
            ->whereBetween('created_at', $dates);
        $total_debit = $res->sum('total_amount') - $res->sum('amount_paid');

        $data = ['data' => [
            'total_debit' => $total_debit,
            'total_credit' => $total_credit,
            'total_expenses' => $expense,
            'total_revenue' => $revenue,
            'net_income' => $revenue -  $expense
        ]];

        auth()->user()->log("Generated finance report for business: '{$bus->name}', id: {$bus->id}");
        return $data;
    }

    /**
     * Inventory
     *
     * Returns the total number of inventory (product and services),
     * expected profits (of all products and services) and
     * the total cost of inventory (both products and services)
     *
     * @authenticated
     *
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @responseFile responses/inventory.reports.summary.json
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function inventory($business_id)
    {
        $bus = Business::findByIdHash($business_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }
        $products = Product::where('business_id', $bus->id);
        $services = Service::where('business_id', $bus->id);
        return [
            'data' => [
                'cost' => [
                    'services' => $services->sum('amount'),
                    'products' => $products->sum('cost_price'),
                    'total' => $services->sum('amount') + $products->sum('cost_price'),
                ],
                'expected_profits' => [
                    'services' => $services->sum('amount'),
                    'products' => $products->sum('cost_price') - $products->sum('selling_price'),
                ],
                'count' => [
                    'products' => $products->count(),
                    'services' => $services->count(),
                    'total'    => $products->count() + $services->count(),
                ]
            ],
        ];
    }

    /**
     * Users
     *
     * Returns the total administrators and attendants of a buinsess
     *
     * @authenticated
     *
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @responseFile responses/inventory.reports.summary.json
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function users($business_id)
    {
        $bus = Business::findByIdHash($business_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }
        $query = Employee::where('business_id', $bus->id);
        return [
            'data' => [
                'attendants' => Employee::where('business_id', $bus->id)->whereHas('role', function ($row) {
                    $row->where('name', 'like', 'attendant');
                })->count(),
                'administrators' => Employee::where('business_id', $bus->id)->whereHas('role', function ($row) {
                    $row->where('name', 'like', 'admin');
                })->count() + 1, // Add 1 for the user who owns the business
            ],
        ];
    }

    /**
     * All
     *
     * Returns a json of sales and finance reports combined
     *
     * @authenticated
     *
     * @urlParam business_id required The id of the business.
     * @queryParam type For finance report, set wether 'weekly', 'yearly'
     *                  or 'monthly' report. Default to weekly if not set.
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function all($bus_id)
    {
        $bus = Business::findByIdHash($bus_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }

        $reports = [
            'finance' => $this->finance($bus_id)['data'],
            'sales' => $this->sales($bus_id)['data'],
            'inventory' => $this->inventory($bus_id)['data'],
            'users' => $this->users($bus_id)['data'],
        ];
        return ['data' => $reports];
    }
}
