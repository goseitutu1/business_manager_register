<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile_money_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->text('tmp_url')->nullable();
            $table->boolean('is_registered')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_registrations');
    }
}
