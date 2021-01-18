<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencySeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(TaxesSeeder::class);
        $this->call(AccountTypesSeeder::class);
        $this->call(BusinessesTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminRolesSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(GLAccountsSeeder::class);
        $this->call(ExpenseCategoriesSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
        $this->call(SubscriptionRenewalPeriodsSeeder::class);
    }
}
