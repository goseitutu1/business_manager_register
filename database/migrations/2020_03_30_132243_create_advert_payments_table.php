<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('id_hash', 500)->unique();
            $table->softDeletes();

            $table->string('mobile_money_number')->nullable();
            $table->double('amount');

            $table->unsignedBigInteger('advert_id');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('momo_transaction_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_payments');
    }
}
