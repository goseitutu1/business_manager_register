<?php

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionPlan::create([
            'name' => 'SoHo',
            'description' => 'Plan description here',
            'minimum_employees' => 1,
            'maximum_employees' => 2,
            'price' => 9.99,
        ]);
        SubscriptionPlan::create([
            'name' => 'Starter',
            'description' => 'Plan description here',
            'minimum_employees' => 1,
            'maximum_employees' => 5,
            'price' => 45.00,
        ]);
        SubscriptionPlan::create([
            'name' => 'Regular',
            'description' => 'Plan description here',
            'minimum_employees' => 1,
            'maximum_employees' => 10,
            'price' => 70.00,
        ]);
        // SubscriptionPlan::create([
        //     'name' => 'Team',
        //     'description' => 'Plan description here',
        //     'minimum_employees' => 1,
        //     'maximum_employees' => 15,
        //     'price' => 179.00,
        // ]);
        SubscriptionPlan::create([
            'name' => 'Enterprise',
            'description' => 'Plan description here',
            'minimum_employees' => 1,
            'maximum_employees' => 20,
            'price' => 99.00,
            'has_employees_limit' => false
        ]);
    }
}
