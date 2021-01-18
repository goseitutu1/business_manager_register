<?php

namespace App\Http\Controllers\Sales;

use App\Models\Tax;
use App\Models\Sales;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Customer;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Http\Requests\ProductSalesRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Session;
use App\DataTables\Sales\ProductDataTable;

class ProductController extends Controller
{
    protected $categories;
    protected $taxes;
    protected $products;

    public function resources()
    {
        $products = Product::where('business_id', session('business_id'))
            ->select('id', 'name', 'selling_price', 'quantity')->get()->toArray();
        $customers = Customer::where('business_id', session('business_id'))
            ->get();
        return (object) [
            'products' => $products,
            'customers' => $customers
        ];
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('sales.product.index', [
            "page" => (object) [
                'title' => "Sales | Products", 'section' => 'Product Sales'
            ],
        ]);
    }


    public function create(ProductSalesRequest $request)
    {
        if ($this->isPostRequest()) {
            session()->put('js_grid', json_decode(request()->get('items')), true);
            if (json_decode($request['items']) == null)
                $this->validate($request, ['items' => 'required']);

            DB::transaction(function () {
                $inputs = request()->all();
                $inputs['items'] = json_decode($inputs['items'], true);
                $inputs = Payment::calculate_payment($inputs);
                $inputs['business_id'] = session('business_id');
                $inputs['attendant_id'] = auth()->user()->id;

                // save sales & sales items
                $sales_inputs = $inputs;
                $sales_inputs['type'] = ($inputs['type'] == "owing") ? "credit_sales" : "cash_sales";
                $sales_inputs['inventory_type'] = "products";
                $sales_inputs['total_payable'] = $inputs['amount_payable'];

                $sales = Sales::create($sales_inputs);
                foreach ($inputs['items'] as $item)
                    $sales->items()->create($item);

                // create new payment
                $inputs['sales_id'] = $sales->id;
                if ($inputs['type'] != 'owing') {
                    $inputs['payment_method'] = 'cash';
                }
                $payment = Payment::create($inputs);

                session()->remove('js_grid');
                auth()->user()->log("created new sales: " . $sales->id);
            });

            Session::flash('alert-success', 'Sales Created Successfully');
            if ($request['save_and_apply'] == "true") return back();
            return redirect()->route('sales.product.index');
        }

        $resources = $this->resources();
        return view('sales.product.create', [
            "page" => (object) [
                'title' => "Sales | New Product Sales", 'section' => 'New Sales'
            ],
            "products" => $resources->products,
            "customers" => $resources->customers
        ]);
    }

    public function edit(ProductSalesRequest $request)
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
                $inputs = Payment::calculate_payment($inputs);
                $inputs['business_id'] = session('business_id');
                $inputs['total_payable'] = $inputs['amount_payable'];

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
                $inputs['type'] = $sales->payment->type;
                $inputs['sales_id'] = $sales->id;
                if ($inputs['type'] != 'owing') {
                    $inputs['payment_method'] = 'cash';
                }
                $sales->payment()->update($inputs);

                session()->remove('js_grid');
                auth()->user()->log("updated sales: " . $sales->id);
            });

            Session::flash('alert-success', 'Sales Updated Successfully');
            return redirect()->route('sales.product.index');
        }

        $resources = $this->resources();
        return view('sales.product.edit', [
            "page" => (object) [
                'title' => "Sales | Edit Sales", 'section' => 'Edit Sales'
            ],
            "data" => $sales,
            "products" => $resources->products,
            "customers" => $resources->customers,
            "items" => json_encode($sales->items)
        ]);
    }


    public function receiptPrint(Request $request)
    {
        $item = Sales::findByIdHash($request->query('item', null));
        if (empty($item)) {
            abort(404);
        }

        $footer_html = view("sales.product.receipt_footer", ['data' => $item])->render();
        $file = SnappyPdf::loadView('sales.product.receipt', ['data' => $item])
            ->setOption('page-width', '72')
            ->setOption('page-height', '200')
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 2)
            ->setOption('margin-right', 2);

        $file->setOption('footer-html', $footer_html);
        return $file->stream($item->sales_no . '.pdf');
    }
}
