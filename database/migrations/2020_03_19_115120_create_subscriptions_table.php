<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash', 500)->unique();
            $table->timestamp('last_payment_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->string('status')->nullable();
            $table->double('amount')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
