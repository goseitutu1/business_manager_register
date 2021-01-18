<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Currency::create([
            'name' => "Ghana Cedi",
            'code' => "GHS",
            'sign' => "¢"
        ]);
    }
}
