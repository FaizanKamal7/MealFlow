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
        Schema::create('business_wallet_transactions', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->decimal("amount", 4, 2);
            $table->dateTime("transaction_date");
            $table->string("note")->nullable();
            $table->string("info")->nullable();
            $table->string("status");
            $table->string("type");

            $table->uuid("payment_method_id")->nullable();
            $table->uuid("wallet_id");
            $table->uuid("invoice_item_id")->nullable();
            $table->uuid("card_id")->nullable();


            $table->timestamps();
            $table->softDeletes();

            $table->foreign("wallet_id")->references("id")->on("business_wallets")->onDelete("cascade");
            $table->foreign("invoice_item_id")->references("id")->on("invoice_items")->onDelete("set null");
            $table->foreign("card_id")->references("id")->on("business_cards")->onDelete("set null");
            $table->foreign("payment_method_id")->references("id")->on("payment_methods")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_wallet_transactions');
    }
};
