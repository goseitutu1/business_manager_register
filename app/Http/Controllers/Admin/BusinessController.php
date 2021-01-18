<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\Admin\Business\BusinessDataTable;
use App\DataTables\Admin\Business\BranchesDataTable;
use App\DataTables\Admin\Business\EmployeeDataTable;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(BusinessDataTable $dataTable)
    {
        return $dataTable->render('admin.business.index', [
            "page" => (object) [
                'title' => "Business Owners", 'section' => 'Businesses Owners'
            ],
        ]);
    }

    public function branches(BranchesDataTable $dataTable)
    {
        return $dataTable->render('admin.business.index', [
            "page" => (object) [
                'title' => "Business Branches", 'section' => 'Branches'
            ],
        ]);
    }


    public function employees(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('admin.business.index', [
            "page" => (object) [
                'title' => "Branch Employees", 'section' => 'Employees'
            ],
        ]);
    }

    public function view(Request $request)
    {
        $business = Business::findOrFail($request->route('id', null));

        return view('admin.business.view', [
            "page" => (object) [
                'title' => "Businesses", 'section' => 'Business | Information'
            ],
            'data' => $business
        ]);
    }
}
