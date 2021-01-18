<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Imports\ServicesImport;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function resources()
    {
        return (object) ['categories' => Category::where('business_id', '=', session('business_id'))->orWhere('business_id', null)->get()];
    }

    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('inventory.service.index', [
            "page" => (object) [
                'title' => "Inventory | Services", 'section' => 'Services'
            ],
        ]);
    }


    /**
     * Handles bulk importing of products from csv or excel file
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $originalFile = $request->file('file');
        try {
            $import = new ServicesImport();
            $import->import($originalFile);

            Session::flash('alert-success', 'Services imported Successfully');
            return redirect()->route('inventory.service.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = ['errors' => $failure->errors(), 'row' => $failure->row()];
            }
            return redirect(route('inventory.service.index'))->with(['errors' => $errors]);
        }
    }

    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('services')->where(function ($query) {
                        return $query->where('business_id', $this->business()->id)
                                     ->where('deleted_at', null);
                    })
                ],
                'amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'category_id' => 'exists:categories,id',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $service = Service::create($inputs);
            auth()->user()->log("created new inventory service: " . $service->name);

            Session::flash('alert-success', 'Service Added Successfully');
            if ($inputs['save_and_apply'] == "true") return back();
            return redirect()->route('inventory.service.index');
        }

        return view('inventory.service.create', [
            "page" => (object) [
                'title' => "Inventory | New Service", 'section' => 'New Service'
            ],
            'categories' => $this->resources()->categories
        ]);
    }

    public function edit(Request $request)
    {
        $item = Service::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'name' => [
                    'required', 'string', 'max:255',
                    Rule::unique('services')
                        ->ignore($item),
                ],
                'amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'category_id' => 'exists:categories,id',
            ]);

            $item->update($request->all());
            auth()->user()->log("updated inventory service: " . $item->id);

            Session::flash('alert-success', 'Service Updated Successfully');
            return redirect()->route('inventory.service.index');
        }
        return view('inventory.service.edit', [
            "page" => (object) [
                'title' => "Inventory | Edit Service", 'section' => 'Edit Service'
            ],
            "data" => $item,
            'categories' => $this->resources()->categories
        ]);
    }

    public function view(Request $request)
    {
        $item = Service::findOrFail($request->route('id', null));

        return view('inventory.service.view', [
            "page" => (object) [
                'title' => "Inventory | Service Details", 'section' => ' Service Details'
            ],
            "data" => $item,
        ]);
    }

    public function delete(Request $request)
    {
        $item = Service::findOrFail($request->route('id', null));

        $item->delete();
        auth()->user()->log("deleted inventory service: " . $item->id);

        Session::flash('alert-success', 'Service Deleted Successfully');
        return redirect()->route('inventory.service.index');
    }
}
