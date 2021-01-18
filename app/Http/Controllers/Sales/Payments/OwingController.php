<?php

namespace App\Http\Controllers\Sales\Payments;

use App\DataTables\Sales\Payment\OwingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OwingController extends Controller
{
    private function resources()
    {
        $customers = Customer::where('business_id', session('business_id'))
            ->get();
        return (object) [
            'customers' => $customers
        ];
    }

    public function index(OwingDataTable $dataTable)
    {
        return $dataTable->render('sales.payment.index', [
            "page" => (object) [
                'title' => "All Payment", 'section' => 'All Payments'
            ],
        ]);
    }

    public function update(Request $request)
    {
        $main = Payment::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate(request(), [
                'payment_completed' => 'required|in:true,false',
                'payment_method' => 'string|max:255',
                'due_date' => 'date',
                'total_amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'amount_paid' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'customer_id' => 'required|exists:customers,id',
                'discount_value' => 'nullable|required_with:discount_type|regex:/^[0-9]{1,12}(\.[0-9]{0,})?$/',
                'discount_type' => 'nullable|required_with:discount_value|string|in:fixed,percentage',
            ]);
            DB::transaction(function () use (&$main) {
                $inputs = request()->all();
                $inputs['business_id'] = session('business_id');

                if ($inputs['payment_completed'] == 'true')
                    $inputs['type'] = "paid";

                //TODO!: decide whether to update sales totals too
                if (isset($inputs['discount_value'])) {
                    if (strtolower($inputs['discount_type']) == 'percentage')
                        $inputs['total_discount'] = $inputs['amount_paid'] * 0.01 * (float) $inputs['discount_value'];
                    else
                        $inputs['total_discount'] =  (float) $inputs['discount_value'];
                }

                // For overpayment, set amount_remaining to zero and
                // add the amount to overpayment_amount
                $diff = $main->amount_owed - $inputs['amount_paid'];
                if ($diff < 0) {
                    $inputs['amount_remaining'] = 0;
                    $inputs['overpayment_amount'] = abs($diff);
                } else {
                    $inputs['amount_remaining'] = $diff;
                }

                // update main & main items
                $main->update($inputs);

                auth()->user()->log("updated payment: " . $main->id);
            });

            Session::flash('alert-success', 'Payment Updated Successfully');
            return redirect()->route('sales.payment.owing.index');
        }

        $resources = $this->resources();
        return view('sales.payment.owing.edit', [
            "page" => (object) [
                'title' => "Sales | Edit Sales", 'section' => 'Edit Sales'
            ],
            "data" => $main,
            "customers" => $resources->customers,
        ]);
    }
}
