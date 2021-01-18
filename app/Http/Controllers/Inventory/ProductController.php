<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function resources()
    {
        return (object) ['categories' => Category::where('business_id', '=', session('business_id'))->orWhere('business_id', null)->get()];
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('inventory.product.index', [
            "page" => (object) [
                'title' => "Inventory | Products", 'section' => 'Products'
            ],
        ]);
    }


    /**
     * Handles bulk importing of products from csv or excel file
     *
     * @param ProductDataTable $dataTable
     * @return void
     */
    public function import(Request $request)
    {
        $originalFile = $request->file('file');
        try {
            $import = new ProductsImport();
            $import->import($originalFile);

            Session::flash('alert-success', 'Products imported Successfully');
            return redirect()->route('inventory.product.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = ['errors' => $failure->errors(), 'row' => $failure->row()];
            }
            return redirect(route('inventory.product.index'))->with(['errors' => $errors]);
        }
    }

    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('products')->where(function ($query) {
                        return $query->where('business_id', $this->business()->id)
                                     ->where('deleted_at', null);
                    })
                ],
                'quantity' => 'numeric|min:0',
                'cost_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'selling_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/|gte:cost_price',
                'stock_threshold' => 'numeric|min:0',
                'expiry_date' => 'nullable|date',
                'location' => 'nullable|string|max:255',
                'category_id' => 'exists:categories,id',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $product = Product::create($inputs);
            auth()->user()->log("created new inventory product: " . $product->name);

            Session::flash('alert-success', 'Product Added Successfully');

            if ($inputs['save_and_apply'] == "true") return back();
            return redirect()->route('inventory.product.index');
        }

        return view('inventory.product.create', [
            "page" => (object) [
                'title' => "Inventory | New Product", 'section' => 'Add Product'
            ],
            'categories' => $this->resources()->categories
        ]);
    }

    public function edit(Request $request)
    {
        $item = Product::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('products')
                        ->ignore($item),
                ],
                'quantity' => 'required|numeric|min:0',
                'cost_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'selling_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'stock_threshold' => 'numeric|min:0',
                'expiry_date' => 'nullable|date',
                'location' => 'nullable|string|max:255',
                'category_id' => 'exists:categories,id',
            ]);

            $item->update($request->all());
            auth()->user()->log("updated inventory product: " . $item->id);

            Session::flash('alert-success', 'Product Updated Successfully');
            return redirect()->route('inventory.product.index');
        }
        return view('inventory.product.edit', [
            "page" => (object) [
                'title' => "Inventory | Edit Product", 'section' => 'Edit Product'
            ],
            "data" => $item,
            'categories' => $this->resources()->categories
        ]);
    }

    public function view(Request $request)
    {
        $item = Product::findOrFail($request->route('id', null));

        return view('inventory.product.view', [
            "page" => (object) [
                'title' => "Inventory | Product Details", 'section' => ' Product Details'
            ],
            "data" => $item,
        ]);
    }

    public function delete(Request $request)
    {
        $item = Product::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted inventory product: " . $item->name);

        Session::flash('alert-success', 'Product Deleted Successfully');
        return redirect()->route('inventory.product.index');
    }
}
