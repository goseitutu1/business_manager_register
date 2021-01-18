<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategoriesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        ExpenseCategory::insert([
            ["name" => "Operational Services", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Space & Equipment or Assets", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Other Bills and Charges", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Payroll & Expenses", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Inventory Purchased", 'id_hash' => HashIdHelper::generateId()],
        ]);
    }
}
