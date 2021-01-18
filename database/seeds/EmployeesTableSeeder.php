<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\Business;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::all()->each(function ($business) {
            factory(User::class, 10)
                ->create()
                ->each(function ($user) use ($business) {
                    Employee::insert([
                        'business_id' => $business->id,
                        'role_id' => Role::first()->id,
                        'user_id' => $user->id,
                        'id_hash' => HashIdHelper::generateId()
                    ]);
                });
        });
    }
}
