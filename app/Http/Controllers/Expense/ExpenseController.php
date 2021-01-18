<?php

namespace App\Http\Controllers\Expense;

use App\DataTables\Expense\ExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExpenseController extends Controller
{
    public function resources()
    {
        $vendors = Vendor::where('business_id', session('business_id'))->get();
        $categories = ExpenseCategory::where('business_id', null)
            ->orWhere('business_id', session('business_id'))->get();
        return (object) [
            'vendors' => $vendors,
            'categories' => $categories
        ];
    }

    public function index(ExpenseDataTable $dataTable)
    {
        return $dataTable->render('expense.index', [
            "page" => (object) [
                'title' => "Expenses", 'section' => 'Expenses'
            ],
        ]);
    }

    public function create(ExpenseRequest $request)
    {
        if ("POST" == request()->method()) {
            DB::transaction(function () use ($request){
                $inputs = $request->validated();
                $inputs['business_id'] = session('business_id');
                if (!empty($inputs['amount_paid'])) {
                    $inputs['amount_remaining'] = $inputs['total_amount'] - $inputs['amount_paid'];
                } else {
                    $inputs['amount_remaining'] = $inputs['total_amount'];
                }
                $expense = Expense::create($inputs);

                auth()->user()->log("created new expense: " . $expense->id);
            });

            Session::flash('alert-success', 'Expense Created Successfully');
            if ($request['save_and_apply'] == "true") return back();
            return redirect()->route('expense.index');
        }

        $res = $this->resources();
        return view('expense.create', [
            "page" => (object) [
                'title' => "Expense | New Expense", 'section' => 'New Expense'
            ],
            'categories' => $res->categories,
            'vendors' => $res->vendors,
        ]);
    }

    public function edit(Expense $expense)
    {
        $res = $this->resources();
        $context = [
            'categories' => $res->categories,
            'vendors' => $res->vendors,
            "page" => (object) [
                'title' => "Expense | Edit Expense", 'section' => 'Edit Expense'
            ],
            'expense' => $expense
        ];


        return view('expense.edit', $context);
    }


    public function update(Expense $expense, ExpenseRequest $request)
    {
        DB::transaction(function () use ($request, $expense){

            $inputs = $request->validated();

            if (!empty($inputs['amount_paid'])) {
                $inputs['amount_remaining'] = $inputs['total_amount'] - $inputs['amount_paid'];
            } else {
                $inputs['amount_remaining'] = $inputs['total_amount'];
            }

            $expense->update($inputs);

            auth()->user()->log("Updated expense: " . $expense->id);
        });

        return redirect()->route('expense.index')->with('alert-success', 'Expense has been updated successfully');
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense.index')->with('alert-success', 'Expense has been deleted successfully');
    }
}
