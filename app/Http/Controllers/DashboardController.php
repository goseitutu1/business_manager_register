<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Service;

class DashboardController extends Controller
{

    /**
     * Index page
     */
    public function index()
    {
        $data = $this->generateReport();
        $data['page_title'] = "Dashboard";
        return view('UI_new.dashboard', $data);
    }

    /**
     * Generate dashboard reports
     */
    private function generateReport()
    {
        $id = session('business_id');
        $type = request()->query('type', 'daily');

        //sales
        $sales_months = array();
        $sales_values = array();
        $sales = [];

        //expenses
        $exp_months = array();
        $exp_values = array();

        $total_expenses = 0;
        $total_sales = 0;
        $sales = [];

        // dates
        $start_date = today()->startOfDay();
        $end_date = today()->endOfDay();

        if ($type == "weekly") {
            $start_date = today()->startOfWeek()->toDateString();
            $end_date = today()->endOfWeek()->toDateString();
        }
        if ($type == "monthly") {
            $start_date = today()->startOfMonth()->toDateString();
            $end_date = today()->endOfMonth()->toDateString();
        }
        if ($type == "yearly") {
            $start_date = today()->startOfYear()->toDateString();
            $end_date = today()->endOfYear()->toDateString();
        }

        $sales  =  Sales::where('business_id', $id)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        $expenses  =  Expense::where('business_id', $id)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        $total_expenses =  $expenses->sum('total_amount');
        $total_sales =  $sales->sum('total');

        collect($sales)->each(function ($sales) use (&$sales_months, &$sales_values) {
            array_push($sales_months, $sales->created_at->format('M-d'));
            array_push($sales_values, $sales->total);
        });

        //expenses
        collect($expenses)->each(function ($expenses) use (&$exp_months, &$exp_values) {
            array_push($exp_months, $expenses->created_at->format('M-d'));
            array_push($exp_values, $expenses->total_amount);
        });

        return [
            'inventory_products' => Product::where('business_id', $id)->count(),
            'inventory_services' => Service::where('business_id', $id)->count(),
            'total_sales' => Sales::where('business_id', $id)->count(),
            'month' => json_encode($sales_months),
            'values' => json_encode($sales_values),
            'exp_month' => json_encode($exp_months),
            'exp_values' => json_encode($exp_values),
            'profit' => $total_sales - $total_expenses,
            'all_expense' => $total_expenses,
            'all_sales' => $total_sales,
            'customers' => Customer::where('business_id', '=', $id)->count(),
        ];
    }
}
