<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWhitelistedIPs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whitelisted_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('ip');
            $table->text('app_user')->nullable();
            $table->text('client_key')->nullable();
            $table->text('client_secrete')->nullable();
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
        Schema::dropIfExists('whitelisted_ips');
    }
}
