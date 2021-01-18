<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('employee.index', [
            "page" => (object) [
                'title' => "Employees", 'section' => 'Employees'
            ],
        ]);
    }


    public function create(Request $request)
    {
        $limit  =  $this->business()->owner->subscription->plan->maximum_employees ?? 0;
        $employees = 0;

        $this->businesses()->each(function ($row) use (&$employees) {
            $employees += $row->employees()->count();
        });

        if ($limit != 0 && $employees != 0) {
            if ($employees > $limit) {
                Session::flash('alert-danger', "You have exceeded the employees limit ($limit). Kindly upgrade your plan in order to create more employees.");
                return redirect()->route('subscription.plan.index');
            }
            if ($employees  == $limit) {
                Session::flash('alert-danger', "You have exhausted the employees limit ($limit). Kindly upgrade your plan in order to create more employees.");
                return redirect()->route('subscription.plan.index');
            }
        }

        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('deleted_at', null);
                    }),
                ],
                'phone_number' => 'required|string|max:20|unique:users,phone_number',
                'mobile_money_number' => 'nullable|string|max:20',
                'country'     => 'nullable|string|max:255',
                'salary_due_date'     => 'nullable|date',
                'salary' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'salary_reminder' => 'nullable|string|max:20',
            ]);

            $inputs = $request->all();
            $inputs['type'] = "employee";
            $inputs['business_id'] = session('business_id');
            $inputs['password'] = "to-be-changed-in-employee-observer";

            $user = User::create($inputs);
            $emp = Employee::create([
                'business_id' => session('business_id'),
                'role_id' => $inputs['role_id'],
                'salary' => $inputs['salary'],
                'salary_due_date' => $inputs['salary_due_date'],
                'salary_reminder' => $inputs['salary_reminder'],
                'user_id' => $user->id,
                'created_by' =>  auth()->user()->id,
            ]);
            auth()->user()->log("created new employee " . $emp->user->full_name);

            Session::flash('alert-success', 'Employee Added Successfully. A confirmation email also been sent');

            if ($inputs['save_and_apply'] == "true") return back();
            return redirect()->route('employee.index');
        }

        return view('employee.create', [
            "page" => (object) [
                'title' => "New Employee", 'section' => 'Add Employee'
            ],
            "roles" => Role::all(),
        ]);
    }

    public function edit(Request $request)
    {
        $main = Employee::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'string|max:255',
                'last_name'    => 'string|max:255',
                'email'        => [
                    'required',
                    'email', Rule::unique('users')
                        ->where('deleted_at', null)
                        ->ignore($main->user)
                ],
                'phone_number' => [
                    'required',
                    'max:20',
                    'string', Rule::unique('users')
                        ->where('deleted_at', null)
                        ->ignore($main->user)
                ],
                'mobile_money_number' => 'nullable|string|max:20',
                'salary_reminder' => 'nullable|string|max:20',
                'country'     => 'nullable|string|max:255',
            ]);

            $inputs = $request->all();
            $inputs['type'] = "employee";
            $inputs['business_id'] = session('business_id');
            $inputs['password'] = "to-be-changed";

            $main->user()->update([
                'first_name' => $inputs['first_name'],
                'last_name' => $inputs['last_name'],
                'email' => $inputs['email'],
                'phone_number' => $inputs['phone_number'],
                'country' => $inputs['country'],
            ]);
            $main->update([
                'role_id' => $inputs['role_id'],
                'salary' => $inputs['salary'],
                'salary_reminder' => $inputs['salary_reminder'],
                'salary_due_date' => $inputs['salary_due_date'],
            ]);
            auth()->user()->log("updated employee: " . $main->id);

            Session::flash('alert-success', 'Employee Updated Successfully');
            return redirect()->route('employee.index');
        }
        return view('employee.edit', [
            "page" => (object) [
                'title' => "Edit Employee", 'section' => 'Edit Employee'
            ],
            "data" => $main,
            "roles" => Role::all(),
        ]);
    }

    public function delete(Request $request)
    {
        $emp = Employee::findOrFail($request->route('id', null));

        $emp->delete();
        auth()->user()->log("deleted employee: " . $emp->user->full_name);

        Session::flash('alert-success', 'Employee Deleted Successfully');
        return redirect()->route('employee.index');
    }
}
