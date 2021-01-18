<?php

use Illuminate\Database\Seeder;

class ProjectSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencySeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(TaxesSeeder::class);
        $this->call(AccountTypesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminRolesSeeder::class);
//        $this->call(GLAccountsSeeder::class);
        $this->call(ExpenseCategoriesSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
        $this->call(SubscriptionRenewalPeriodsSeeder::class);
    }
}
