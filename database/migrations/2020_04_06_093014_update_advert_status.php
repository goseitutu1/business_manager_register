<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\AdvertStatus;

class UpdateAdvertStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        AdvertStatus::create(['name' => 'Published']);
        AdvertStatus::create(['name' => 'Unpublished']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('advert_status', function (Blueprint $table) {
        //     //
        // });
    }
}
