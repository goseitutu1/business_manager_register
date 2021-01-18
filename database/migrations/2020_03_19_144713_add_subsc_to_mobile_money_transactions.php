<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscToMobileMoneyTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_money_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->nullable();

            // update this columns
            $table->text('phone_number')->nullable()->change();
            $table->text('vendor')->nullable()->change();
            $table->text('transaction_id')->nullable()->change();
            $table->text('transaction_type')->nullable()->change();
            $table->text('message')->nullable()->change();
            $table->text('payment_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_money_transactions', function (Blueprint $table) {
            $table->dropColumn('subscription_id');

            $table->text('phone_number')->nullable(false)->change();
            $table->text('vendor')->nullable(false)->change();
            $table->text('transaction_id')->nullable(false)->change();
            $table->text('transaction_type')->nullable(false)->change();
            $table->text('payment_id')->nullable(false)->change();
        });
    }
}
