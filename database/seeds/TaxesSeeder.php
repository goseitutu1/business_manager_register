<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Tax::insert([
            ['name' => 'vat', 'percentage' => 12.5, 'id_hash' => HashIdHelper::generateId()],
            ['name' => 'New VAT & NHIL & CF', 'percentage' => 19.13, 'id_hash' => HashIdHelper::generateId()],
            ['name' => 'Withholding Tax Corporate', 'percentage' => 7.5, 'id_hash' => HashIdHelper::generateId()],
            ['name' => 'NHIL', 'percentage' => 2.5, 'id_hash' => HashIdHelper::generateId()],
            ['name' => 'GETFUND', 'percentage' => 2.5, 'id_hash' => HashIdHelper::generateId()],
            ['name' => 'Withholding Tax Vat', 'percentage' => 7, 'id_hash' => HashIdHelper::generateId()],
        ]);
    }
}
