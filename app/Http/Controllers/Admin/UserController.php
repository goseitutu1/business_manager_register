<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\AdminAccountCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\DataTables\Admin\UserDataTable;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index', [
            "page" => (object) [
                'title' => "Users", 'section' => 'Users'
            ],
        ]);
    }


    public function create(Request $request)
    {
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
                'phone_number' => 'nullable|string|max:20|unique:users,phone_number',
                'mobile_money_number' => 'nullable|string|max:20',
                'country'     => 'nullable|string|max:255',
                'role_id'     => 'required|exists:admin_roles,id',
            ]);

            $inputs = $request->all();
            DB::transaction(function () use ($inputs) {
                $password = Str::random(10);
                $inputs['type'] = "admin";
                $inputs['password'] = Hash::make($password);
                $user = User::create($inputs);
                auth()->user()->log("created new user " . $user->id);

                $admin = Admin::create([
                    'user_id' => $user->id,
                    'role_id' => $inputs['role_id'],
                    'created_by' => auth()->user()->id
                ]);
                auth()->user()->log("created new admin account " . $admin->id);

                Mail::to($user)
                    ->send(new AdminAccountCreated($admin, $password));

                auth()->user()->log("sent notification email for user:" . $user->full_name);

                Session::flash('alert-success', 'User Added Successfully. A confirmation email also been sent');
            });

            if ($inputs['save_and_apply'] == "true") return back();
            return redirect()->route('admin.user.index');
        }

        return view('admin.user.create', [
            "page" => (object) [
                'title' => "New User", 'section' => 'Add User'
            ],
            "roles" => AdminRole::all(),
        ]);
    }

    public function edit(Request $request)
    {
        $main = Admin::findOrFail($request->route('id', null));
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'first_name'   => 'string|max:255',
                'last_name'    => 'string|max:255',
                'email'        => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) use ($main) {
                        $user = User::where('email', $value)
                            ->where('id', '!=', $main->user->id)->first();
                        if ($user !== null) {
                            $fail('Email already exists.');
                        }
                    },
                ],
                'phone_number' => [
                    'nullable',
                    'max:20',
                    'string',
                    function ($attribute, $value, $fail) use ($main) {
                        $user = User::where('phone_number', $value)
                            ->where('id', '!=', $main->user->id)->first();
                        if ($user !== null) {
                            $fail('Phone number already exists.');
                        }
                    },
                ],
                'mobile_money_number' => 'nullable|string|max:20',
                'country'     => 'nullable|string|max:255',
                'role_id'     => 'required|exists:admin_roles,id',

            ]);

            $inputs = $request->all();
            DB::transaction(function () use ($inputs, &$main) {
                $main->user->update([
                    'first_name' => $inputs['first_name'],
                    'last_name' => $inputs['last_name'],
                    'email' => $inputs['email'],
                    'phone_number' => $inputs['phone_number'],
                    'country' => $inputs['country'],
                ]);
                auth()->user()->log("updated user: " . $main->user->id);

                $main->update(['role_id' => $inputs['role_id']]);
                auth()->user()->log("updated admin: " . $main->id);

                Session::flash('alert-success', 'User Updated Successfully');
            });
            return redirect()->route('admin.user.index');
        }

        return view('admin.user.edit', [
            "page" => (object) [
                'title' => "Edit User", 'section' => 'Edit User'
            ],
            "data" => $main,
            "roles" => AdminRole::all(),
        ]);
    }
    public function view(Request $request)
    {
        $main = Admin::findOrFail($request->route('id', null));

        return view('admin.user.view', [
            "page" => (object) [
                'title' => "User Information", 'section' => 'User Information'
            ],
            "data" => $main,
        ]);
    }

    public function delete(Request $request)
    {
        $admin = Admin::findOrFail($request->route('id', null));
        DB::transaction(function() use ($admin){
            if(!empty($admin->user)){
                $admin->user->delete();
            }
            $admin->delete();
            auth()->user()->log("deleted admin: " . $admin->id);

            Session::flash('alert-success', 'Admin Deleted Successfully');
        });

        return redirect()->route('admin.user.index');
    }
}
