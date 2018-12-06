<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTransactionEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transaction_entities', function (Blueprint $table) {
            $table->increments('id');

            $table->float('amount')->default(0);
            $table->string('reason', 255);

            // probably not needed but I leaving them here.
            $table->timestamps();

            $table->uuid('bank_transaction_id');
            $table->foreign('bank_transaction_id')
                  ->references('uuid')
                  ->on('bank_transactions')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transaction_entities');
    }
}
