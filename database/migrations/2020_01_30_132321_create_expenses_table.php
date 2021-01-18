<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_hash', 500)->unique();
            $table->text('description')->nullable();
            $table->string('type', 500)->default('paid');
            $table->dateTime('due_date')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('amount_owed')->nullable();
            $table->double('amount_remaining')->nullable();

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('journal_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('expenses');
    }
}
