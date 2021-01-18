<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToPayments extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['total_paid', 'total_payable']);

            $table->string('type', 500)->default('owing');
            $table->double('total_amount')->nullable();
            $table->double('amount_remaining')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('amount_owed')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('batch_no')->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('journal_id')->nullable();
            $table->unsignedBigInteger('shopping_cart_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
