<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('expense.index', [
            "page" => (object) [
                'title' => "Suppliers", 'section' => 'Suppliers'
            ],
        ]);
    }


    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'description'  => 'string|nullable|max:500',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('vendors')->where(function ($query) {
                        return $query->where('deleted_at', null);
                    }),
                ],
                'phone_number' => 'required|string|max:20',
                'location'     => 'nullable|string|max:255',
                'description'     => 'nullable|string|max:255',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $resp = Vendor::create($inputs);
            auth()->user()->log("created new supplier " . $resp->name);

            Session::flash('alert-success', 'Supplier Added Successfully');

            if ($inputs['save_and_apply'] == "true") return back();
            $next = request()->query('next', null);
            if (isset($next)) {
                return redirect($next);
            }
            return redirect()->route('suppliers.index');
        }

        return view('supplier.create', [
            "page" => (object) [
                'title' => "New Supplier", 'section' => 'Add Supplier'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $vendor = Vendor::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'string|max:255',
                'last_name'    => 'string|max:255',
                'description'    => 'string|nullable|max:500',
                'email'        => [
                    'nullable',
                    'email', Rule::unique('vendors')
                        ->where('deleted_at', null)
                        ->ignore($vendor)
                ],
                'phone_number' => 'required|string|max:20',
                'location'     => 'nullable|string|max:255',
            ]);

            $vendor->update($request->all());
            auth()->user()->log("updated supplier: " . $vendor->id);

            Session::flash('alert-success', 'Supplier Updated Successfully');
            return redirect()->route('suppliers.index');
        }
        return view('supplier.edit', [
            "page" => (object) [
                'title' => "Edit Supplier", 'section' => 'Edit Supplier'
            ],
            "data" => $vendor,
        ]);
    }

    /**
     * View the details of a vendor
     *
     * @param Request $request
     * @return void
     */
    public function view(Request $request)
    {
        $vendor = Vendor::findOrFail($request->route('id', null));

        return view('supplier.view', [
            "page" => (object) [
                'title' => "Supplier Details", 'section' => 'Supplier Details'
            ],
            "data" => $vendor,
        ]);
    }

    public function delete(Request $request)
    {
        $item = Vendor::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted supplier: " . $item->name);

        Session::flash('alert-success', 'Supplier Deleted Successfully');
        return redirect()->route('suppliers.index');
    }
}
