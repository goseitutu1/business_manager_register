<?php

namespace App\Http\Controllers\Expense;

use App\DataTables\Expense\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('expense.category.index', [
            "page" => (object) [
                'title' => "Expense | Categories", 'section' => 'Categories'
            ],
        ]);
    }

    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => 'required|unique:expense_categories,name|string|max:255',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id', null);
            $category = ExpenseCategory::create($inputs);
            auth()->user()->log("created new expense category: " . $category->name);

            Session::flash('alert-success', 'Category Added Successfully');
            return redirect()->route('expense.category.index');
        }
    }

    public function edit(Request $request)
    {
        $item = ExpenseCategory::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);

            $item->update($request->all());
            auth()->user()->log("updated expense category: " . $item->id);

            Session::flash('alert-success', 'Category Updated Successfully');
            return redirect()->route('expense.category.index');
        }
        return view('expense.category.edit', [
            "page" => (object) [
                'title' => "Expense | Edit Category", 'section' => 'Edit Category'
            ],
            "data" => $item
        ]);
    }

    public function delete(Request $request)
    {
        $item = ExpenseCategory::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted expense category: " . $item->name);

        Session::flash('alert-success', 'Category Deleted Successfully');
        return redirect()->route('expense.category.index');
    }
}
