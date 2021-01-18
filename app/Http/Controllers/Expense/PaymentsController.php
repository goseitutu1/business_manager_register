<?php

namespace App\Http\Controllers\Expense;

use App\DataTables\Expense\PaymentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpensePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{
    public function index(PaymentsDataTable $dataTable)
    {
        return $dataTable->render('expense.index', [
            "page" => (object) [
                'title' => "Expenses | Expense Payments", 'section' => 'Expense Payments'
            ],
        ]);
    }

    public function create(Request $request)
    {
        $expense = Expense::findOrFail($request->route('expense_id'));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'description' => 'nullable|string',
                'payment_date' => 'nullable|date',
                'amount_paid' => "required|min:0|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/|max:{$expense->amount_remaining}",
            ]);

            DB::transaction(function () use (&$expense) {
                $inputs = request()->all();
                $inputs['old_balance'] = $expense->amount_remaining;
                $inputs['new_balance'] = $expense->amount_remaining - $inputs['amount_paid'];

                $payment = $expense->payments()->create([
                    'description' => $inputs['description'],
                    'payment_date' => $inputs['payment_date'],
                    'new_balance' => $inputs['new_balance'],
                    'old_balance' => $inputs['old_balance'],
                    'amount_paid' => $inputs['amount_paid'],
                    'business_id' => session('business_id')
                ]);

                auth()->user()->log(
                    "made new payment ({$payment->id}) for expense: " . $expense->id
                );
            });

            Session::flash('alert-success', 'Expense Payment Created Successfully');
            if ($request['save_and_apply'] == "true") return back();
            return redirect()->route('expense.payments.index', ['expense_id' => $expense->id]);
        }

        return view('expense.payments.create', [
            "page" => (object) [
                'title' => "Expense |  Pay Expense", 'section' => 'New Expense Payment'
            ],
            "expense" => $expense
        ]);
    }

    public function delete(Request $request)
    {
        $item = ExpensePayment::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted expense payment: " . $item->code);

        Session::flash('alert-success', 'Expense Payment Deleted Successfully');
        return redirect()->route('expense.payments.index', ['expense_id' => $item->expense->id]);
    }
}
