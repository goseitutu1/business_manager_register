<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("id_hash", 500)->unique();
            $table->timestamp("entry_time")->useCurrent();
            $table->boolean("is_posted")->default(false);
            $table->text("entry_code");
            $table->text("comment");
            $table->double("amount");

            $table->unsignedBigInteger("debit_account_id")->nullable();
            $table->unsignedBigInteger("credit_account_id")->nullable();
            $table->unsignedBigInteger("journal_id");
            $table->unsignedBigInteger("business_id")->nullable();

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
        Schema::dropIfExists('journal_entries');
    }
}
