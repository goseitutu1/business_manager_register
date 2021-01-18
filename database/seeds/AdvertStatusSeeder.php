<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\AdvertStatus;
use Illuminate\Database\Seeder;

class AdvertStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdvertStatus::insert([
            ["name" => "Pending Approval", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Approved", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Denied", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Pending Payment", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Payment Completed", 'id_hash' => HashIdHelper::generateId()],
        ]);
    }
}
