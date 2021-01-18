<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('id_hash')->unique();
            $table->text('name');
            $table->text('type');
            $table->text('location');
            $table->text('logo')->nullable();
            $table->text('reg_no')->nullable();
            $table->text('tax_no')->nullable();
            $table->text('vat_no')->nullable();

            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('businesses');
    }
}
