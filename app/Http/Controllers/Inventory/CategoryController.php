<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('inventory.category.index', [
            "page" => (object) [
                'title' => "Inventory | Categories", 'section' => 'Categories'
            ],
        ]);
    }

    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'category_name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('categories', 'name')->where(function ($query) {
                        return $query->where('business_id', $this->business()->id)
                            ->where('deleted_at', null);
                    })
                ]
            ]);

            $inputs = $request->all();
            $inputs['name'] = $inputs['category_name'];
            $inputs['business_id'] = session('business_id');
            $category = Category::create($inputs);
            auth()->user()->log("created new inventory category: " . $category->name);

            Session::flash('alert-success', 'Category Added Successfully');
            return back();
        }

        return view('inventory.category.create', [
            "page" => (object) [
                'title' => "Inventory | New Category", 'section' => 'Categories'
            ],
        ]);
    }

    public function edit(Request $request)
    {
        $item = Category::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);

            $item->update($request->all());
            auth()->user()->log("updated inventory category: " . $item->id);

            Session::flash('alert-success', 'Category Updated Successfully');
            return redirect()->route('inventory.category.index');
        }
        return view('inventory.category.edit', [
            "page" => (object) [
                'title' => "Inventory | Edit Category", 'section' => 'Edit Category'
            ],
            "data" => $item
        ]);
    }

    public function delete(Request $request)
    {
        $item = Category::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted inventory category: " . $item->id);

        Session::flash('alert-success', 'Category Deleted Successfully');
        return redirect()->route('inventory.category.index');
    }
}
