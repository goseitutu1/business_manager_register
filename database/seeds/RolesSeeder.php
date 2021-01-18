<?php

use App\Api\Helpers\HashIdHelper;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::insert([
            ["name" => "Admin", 'id_hash' => HashIdHelper::generateId()],
            ["name" => "Attendant", 'id_hash' => HashIdHelper::generateId()],
        ]);
    }
}
