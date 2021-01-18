<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_hash', 500)->unique();
            $table->boolean('discount_applied')->default(false);
            $table->text('payment_method')->nullable();
            $table->text('discount_type')->nullable();
            $table->double('discount_value')->nullable();
            $table->double('total_payable');
            $table->double('total_paid');

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('product_sales_id')->nullable();
            $table->unsignedBigInteger('service_sales_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('payments');
    }
}
