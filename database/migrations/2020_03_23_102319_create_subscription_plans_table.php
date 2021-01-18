<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash', 500)->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('minimum_employees')->nullable();
            $table->integer('maximum_employees')->nullable();
            $table->double('price')->nullable();
            $table->boolean('has_employees_limit')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
}
