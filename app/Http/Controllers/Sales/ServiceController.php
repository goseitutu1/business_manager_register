<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Sales\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSales;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sales;
use App\Models\Service;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function resources()
    {
        $services = Service::where('business_id', session('business_id'))
            ->select('id', 'name', 'amount')->get()->toArray();
        $customers = Customer::where('business_id', session('business_id'))
            ->get();
        return (object) [
            'taxes' => Tax::all()->toArray(),
            'services' => $services,
            'customers' => $customers
        ];
    }

    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('sales.service.index', [
            "page" => (object) [
                'title' => "Sales | Services", 'section' => 'Services Sales'
            ],
        ]);
    }


    public function create(CreateSales $request)
    {
        if ($this->isPostRequest()) {
            session()->put('js_grid', json_decode(request()->get('items')), true);
            if (json_decode($request['items']) == null)
                $this->validate($request, ['items' => 'required']);

            DB::transaction(function () {
                $inputs = request()->all();
                $inputs['items'] = json_decode($inputs['items'], true);
                $inputs = Payment::calculate_payment($inputs, "service");
                $inputs['business_id'] = session('business_id');
                $inputs['attendant_id'] = auth()->user()->id;

                // save sales & sales items
                // save sales & sales items
                $sales_inputs = $inputs;
                $sales_inputs['type'] = ($inputs['type'] == "owing") ? "credit_sales" : "cash_sales";
                $sales_inputs['inventory_type'] = "services";

                $sales = Sales::create($sales_inputs);
                foreach ($inputs['items'] as $item)
                    $sales->items()->create($item);

                // create new payment
                $inputs['sales_id'] = $sales->id;
                if ($inputs['type'] == 'cash_sales') {
                    $inputs['payment_method'] = 'cash';
                }
                $payment = Payment::create($inputs);

                session()->remove('js_grid');
                auth()->user()->log("created new sales: " . $sales->id);
                auth()->user()->log("created sales payment: " . $payment->id);
            });

            Session::flash('alert-success', 'Sales Created Successfully');
            if ($request['save_and_apply'] == "true") return back();
            return redirect()->route('sales.service.index');
        }

        $resources = $this->resources();
        return view('sales.service.create', [
            "page" => (object) [
                'title' => "Sales | New Service Sales", 'section' => 'New Sales'
            ],
            "taxes" => $resources->taxes,
            "services" => $resources->services,
            "customers" => $resources->customers
        ]);
    }

    public function edit(CreateSales $request)
    {
        $sales = Sales::findOrFail($request->route('id', null));
        if ($this->isPostRequest()) {
            session()->put('js_grid', json_decode(request()->get('items')), true);
            if (json_decode($request['items']) == null)
                $this->validate($request, ['items' => 'required']);

            DB::transaction(function () use (&$sales) {
                $inputs = request()->all();
                $inputs['items'] = json_decode($inputs['items'], true);
                $inputs['type'] = $sales->payment->type;
                $inputs = Payment::calculate_payment($inputs, "service");
                $inputs['business_id'] = session('business_id');

                // update sales & sales items
                unset($inputs['type']);
                $sales->update($inputs);

                $active = [];
                foreach ($inputs['items'] as $item) {
                    $new = $sales->items()->updateOrCreate($item);
                    $active[] = $new->id;
                }

                // delete remove items
                $sales->items()->whereNotIn('id', $active)->delete();

                // update payment
                $inputs['sales_id'] = $sales->id;
                $inputs['type'] = $sales->payment->type;
                $sales->payment()->update($inputs);

                session()->remove('js_grid');
                auth()->user()->log("updated sales: " . $sales->id);
            });

            Session::flash('alert-success', 'Sales Updated Successfully');
            return redirect()->route('sales.service.index');
        }

        $resources = $this->resources();
        return view('sales.service.edit', [
            "page" => (object) [
                'title' => "Sales | Edit Sales", 'section' => 'Edit Sales'
            ],
            "data" => $sales,
            "taxes" => $resources->taxes,
            "services" => $resources->services,
            "customers" => $resources->customers,
            "items" => json_encode($sales->items)
        ]);
    }

    public function receiptPrint(Request $request)
    {
        $controller = new ProductController();
        return  $controller->receiptPrint($request);
    }
}
