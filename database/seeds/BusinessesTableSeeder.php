<?php

use App\Models\Business;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Business::class, 5)
            ->create()
            ->each(function ($business) {
                $business->products()->createMany(
                    factory(Product::class, 10)->make()->toArray()
                );
                $business->services()->createMany(
                    factory(Service::class, 10)->make()->toArray()
                );
                $business->customers()->createMany(
                    factory(Customer::class, 10)->make()->toArray()
                );
                $business->vendors()->createMany(
                    factory(Vendor::class, 10)->make()->toArray()
                );
            });
    }
}
