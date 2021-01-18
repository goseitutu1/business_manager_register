<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('id_hash', 500)->unique();
            $table->text('name');
            $table->text('bank_account_number')->nullable();
            $table->text('mobile_money_wallet')->nullable();

            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('account_type_id')->nullable();
            $table->unsignedBigInteger('business_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('accounts');
    }
}
