<?php

use App\Models\SubscriptionRenewalPeriod;
use Illuminate\Database\Seeder;

class SubscriptionRenewalPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionRenewalPeriod::insert([
            ["name" => "Monthly", 'days' => 30, 'months' => 1],
            ["name" => "Quarterly", 'days' => 90, 'months' => 3],
            ["name" => "Bi Annually", 'days' => 180, 'months' => 6],
            ["name" => "Annually", 'days' => 360, 'months' => 12],
        ]);
    }
}
