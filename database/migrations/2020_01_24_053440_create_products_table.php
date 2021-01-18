<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash', 500)->unique();
            $table->text('name');
            $table->double('quantity');
            $table->double('cost_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->double('stock_threshold')->nullable();
            $table->boolean('can_expire')->default(false);
            $table->date('expiry_date')->nullable();
            $table->text('location')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('products');
    }
}
