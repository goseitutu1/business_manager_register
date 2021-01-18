<?php

namespace App\Http\Controllers;

use App\DataTables\Customer\CustomerDataTable;
use App\DataTables\Customer\TransactionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customer.index', [
            "page" => (object) [
                'title' => "Customers", 'section' => 'Customers'
            ],
        ]);
    }

    public function transactions(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('customer.index', [
            "page" => (object) [
                'title' => "Customers", 'section' => 'Customers'
            ],
        ]);
    }


    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('customers')->where(function ($query) {
                        return $query->where('deleted_at', null);
                    }),
                ],
                'phone_number' => 'string|max:20',
                'location'     => 'nullable|string|max:255',
                'address'      => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date|before:today',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $inputs['created_by'] = auth()->user()->id;

            $resp = Customer::create($inputs);
            auth()->user()->log("created new customer " . $resp->name);

            Session::flash('alert-success', 'Customer Added Successfully');

            if ($inputs['save_and_apply'] == "true") return back();
            $next = request()->query('next', null);
            if (isset($next)) {
                return redirect($next);
            }
            return redirect()->route('customer.index');
        }

        return view('customer.create', [
            "page" => (object) [
                'title' => "New Customer", 'section' => 'Add Customer'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $customer = Customer::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'string|max:255',
                'last_name'    => 'string|max:255',
                'email'        => [
                    'nullable',
                    'email', Rule::unique('customers')
                        ->where('deleted_at', null)
                        ->ignore($customer)
                ],
                'phone_number' => 'string|max:20',
                'location'     => 'nullable|string|max:255',
                'address'      => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date|before:today',
            ]);

            $customer->update($request->all());
            auth()->user()->log("updated customer: " . $customer->id);

            Session::flash('alert-success', 'Customer Updated Successfully');
            return redirect()->route('customer.index');
        }
        return view('customer.edit', [
            "page" => (object) [
                'title' => "Edit Customer", 'section' => 'Edit Customer'
            ],
            "data" => $customer,
        ]);
    }

    public function view(Request $request)
    {
        $customer = Customer::findOrFail($request->route('id', null));

        return view('customer.view', [
            "page" => (object) [
                'title' => "View Customer", 'section' => 'Customer Details'
            ],
            "data" => $customer,
        ]);
    }

    public function delete(Request $request)
    {
        $item = Customer::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted customer: " . $item->name);

        Session::flash('alert-success', 'Customer Deleted Successfully');
        return redirect()->route('customer.index');
    }
}
