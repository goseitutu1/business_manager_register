<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_hash', 500)->unique();
            $table->double('quantity')->nullable();
            $table->double('total');
            $table->double('unit_price')->nullable();
            $table->double('tax_amount')->nullable();
            $table->boolean('is_taxed')->default(false);
            $table->string('discount_type', 250)->nullable();
            $table->double('discount_amount')->nullable();

            $table->unsignedBigInteger('tax_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('sales_id');
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
        Schema::dropIfExists('sales_items');
    }
}
