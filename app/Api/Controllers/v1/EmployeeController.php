<?php

namespace App\Api\Controllers\v1;

use App\Models\Role;
use App\Models\User;
use App\Models\Business;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Api\Controllers\BaseController;
use App\Api\Requests\v1\EmployeeRequest;
use Illuminate\Support\Facades\Validator;
use App\Api\Transformers\v1\EmployeeTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;

/**
 * @group Employee
 *
 * APIs for managing employees
 */
class EmployeeController extends BaseController
{
    /**
     * Create Employee
     *
     * @authenticated
     *
     * @transformer App\Api\Transformers\v1\EmployeeTransformer
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The selected business id is invalid.",
     *  "errors": {
     *     "business_id": ["The selected business id is invalid."]
     *   }
     * }
     *
     * @param EmployeeRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(EmployeeRequest $request)
    {
        $data = $request->all();
        $business = Business::findByIdHash($data['business_id']);
        $data['type'] = "employee";
        DB::transaction(function () use ($data, $business) {
            if (!empty($data['passsowrd']))
                $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $data['role_id'] = Role::where('name', 'like', $data['role'] ?? "attendant")->first()->id;

            $emp = Employee::create([
                'business_id' => $business->id,
                'role_id' => $data['role_id'],
                'user_id' => $user->id
            ]);

            auth()->user()->log("created new employee. name: '{$user->full_name}'. id: {$emp->id}");
        });

        return $this->response->item(Employee::latest()->first(), new EmployeeTransformer());
    }

    /**
     * Update Employee
     *
     * Update the information of an employee.
     * Since an employee is a normal user, all the other information (first_name, last_name, email, etc)
     * can be updated using the users api.
     * This api is for changing only role and the business of the employee.
     *
     * @authenticated
     * @urlParam id required The id of the employee. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\EmployeeTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The selected business id is invalid.",
     *  "errors": {
     *     "business_id": ["The selected business id is invalid."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Customer not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request)
    {
        $employee = Employee::findByIdHash(request('id', ''));
        if (!isset($employee))
            $this->response->errorNotFound("Employee not found");

        $validator = Validator::make($request->all(), [
            'role' => 'exists:roles,name',
            'business_id' => 'exists:businesses,id_hash'
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $data = request()->all();
        if (!empty($data['role']))
            $data['role_id'] = Role::where('name', 'like', $data['role'])->first()->id;

        // Remove id_hash, id fields it exist
        unset($data['id_hash'], $data['id']);

        $employee->update($data);
        auth()->user()->log("updated employee: {$employee->user->full_name}, id: {$employee->id}");
        return $this->response->item($employee, new EmployeeTransformer());
    }

    /**
     * All Employees
     *
     * Returns the json representation of all employees of a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\EmployeeTransformer
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Employee::where('business_id', $bus->id)->get();

        auth()->user()->log("viewed all employees for business: {$bus->name}");
        return $this->response->collection($res, new EmployeeTransformer());
    }

    /**
     * View Employee
     *
     * Returns the json representation of an employee
     *
     * @authenticated
     * @urlParam id required The id of the employee. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\EmployeeTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Employee not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view()
    {
        $res = Employee::findByIdHash(request('id'));
        if (!isset($res))
            $this->response->errorNotFound("Employee not found");

        auth()->user()->log("Viewed employee: {$res->user->full_name}, id: {$res->id}");
        return $this->response->item($res, new EmployeeTransformer());
    }

    /**
     * Delete Employee
     *
     * @authenticated
     * @urlParam id required The id of the employee. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Employee deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Employee not found"
     * }
     */
    public function delete()
    {
        $res = Employee::findByIdHash(request('id', ''));
        if (!isset($res))
            $this->response->errorNotFound("Employee not found");

        $res->delete();
        auth()->user()->log("Deleted Employee: {$res->user->usfull_name}, id: {$res->id}");
        return ['status_code' => 200, 'message' => "Employee deleted successfully"];
    }
}
