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
        Schema::create('wallet_deductions', function (Blueprint $table) {
            $table->uuid("id")->primary();
            
            $table->decimal("amount", 4, 2);
            $table->dateTime("transaction_date");

            $table->uuid("wallet_id");
            $table->uuid("invoice_item_id")->nullable();

            $table->timestamps();

            $table->foreign("wallet_id")->references("id")->on("business_wallet")->onDelete("cascade");
            $table->foreign("invoice_item_id")->references("id")->on("invoice_items")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_deductions');
    }
};
