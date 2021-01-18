<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSalesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_hash', 500)->unique();
            $table->date("payment_date")->nullable();
            $table->double("total");
            $table->double("quantity");
            $table->double("unit_price");
            $table->text("tax_type")->nullable();
            $table->double("total_tax")->default(0);
            $table->boolean("is_taxed")->default(false);

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product_sales');
    }
}
