<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_credits', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->decimal("amount", 4, 2);
            $table->dateTime("transaction_date");
            $table->string("payment_method");

            $table->uuid("wallet_id");
            $table->uuid("card_id")->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign("wallet_id")->references("id")->on("business_wallet")->onDelete("cascade");
            $table->foreign("card_id")->references("id")->on("business_cards")->onDelete("set null");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_credits');
    }
};
