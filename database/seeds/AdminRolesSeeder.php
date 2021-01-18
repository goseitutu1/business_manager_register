<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminRole::insert([
            ["name" => "Super Admin", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Reviewer", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Approver", 'id_hash' => HashIdHelper::generateId()],
        ]);
    }
}
