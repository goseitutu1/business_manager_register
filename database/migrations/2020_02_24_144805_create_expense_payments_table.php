<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash', 500)->unique();
            $table->string('code', 500);
            $table->text('description')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('old_balance')->nullable();
            $table->double('new_balance')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('expense_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_payments');
    }
}
