<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Str;
use App\Api\Helpers\HashIdHelper;
use App\Mail\EmployeeAccountCreated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeObserver
{
    /**
     * Handle the employee "creating" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
    {
        $employee->id_hash = HashIdHelper::generateId();
    }


    /**
     * Handle the employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        // create new password for the employee
        $password = Str::random(8);
        $employee->user()->update(['password' => Hash::make($password)]);

        // send mail if the environment is not testing
        if (!preg_match('/testing/i', env('APP_ENV'))) {
            Mail::to($employee->user)
                ->send(new EmployeeAccountCreated($employee, $password));
        }
    }

    /**
     * Handle the employee "updated" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        //
    }

    /**
     * Handle the employee "deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        $user =  $employee->user;
        $employee->user()->delete();
        auth()->user()->log("deleted user: " . $user->id);
    }

    /**
     * Handle the employee "restored" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        $employee->user()->restore();
    }

    /**
     * Handle the employee "force deleted" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        $employee->user()->forceDeleted();
    }
}
