<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMomoTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_money_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double("amount");
            $table->string("phone_number")->nullable();
            $table->text("vendor");
            $table->text("transaction_id");
            $table->text("transaction_type");
            $table->text("message");
            $table->text("response_status")->nullable();
            $table->text("response_message")->nullable();
            $table->text("voucher")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_money_transactions');
    }
}
