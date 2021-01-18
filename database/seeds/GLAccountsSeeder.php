<?php

use App\Models\GLAccount;
use Illuminate\Database\Seeder;

class GLAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            ["name" => "Sales Product"],
            ["name" => "Cost of Sales Products"],
            ["name" => "Sales Service"],
            ["name" => "Cost of Sales Services"],
            ["name" => "Stock"],
            ["name" => "Bank"],
            ["name" => "Debtors"],
            ["name" => "Creditors"],
            ["name" => "Other Revenue"],

            // other accounts
            ["name" => "Operational Services"],
            ["name" => "Space & Equipment or Assets"],
            ["name" => "Other Bills and Charges"],
            ["name" => "Payroll & Expenses"],
            ["name" => "Inventory Purchased"],
        ];

        foreach ($accounts as $acct)
            GLAccount::create($acct);
    }
}
