<?php

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        AccountType::create(['name' => 'Expenses', 'code' => 000001]);
        AccountType::create(['name' => 'Revenue', 'code' => 000002]);
        AccountType::create(['name' => 'Operations', 'code' => 000003]);
    }
}
