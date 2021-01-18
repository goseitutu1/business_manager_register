<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("id_hash", 500)->unique();
            $table->date('transaction_date')->nullable();
            $table->date('reversal_date')->nullable();
            $table->text('batch_no');
            $table->text('description')->nullable();
            $table->double('debit_total');
            $table->double('credit_total');
            $table->boolean('is_posted')->default(false);

            $table->unsignedBigInteger('business_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('journals');
    }
}
