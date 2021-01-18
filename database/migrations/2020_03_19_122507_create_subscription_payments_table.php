<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash', 500)->unique();
            $table->timestamp('payment_date')->nullable();
            $table->double('amount')->nullable();
            $table->string('mobile_money_number')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('subscription_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_payments');
    }
}
