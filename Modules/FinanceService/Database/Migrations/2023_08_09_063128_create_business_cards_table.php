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
        Schema::create('business_cards', function (Blueprint $table) {
            $table->uuid("id")->primary(); 
            
            $table->string("card_holder_name");
            $table->unsignedSmallInteger("cvv");
            $table->unsignedSmallInteger('expiry_month'); 
            $table->unsignedSmallInteger('expiry_year');

            $table->uuid("wallet_id");

            $table->timestamps();

            $table->foreign("wallet_id")->references("id")->on("business_wallet")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_cards');
    }
};
