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
        Schema::create('business_wallet', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->decimal("balance", 8, 2);

            $table->uuid("business_id");

            $table->timestamps();

            $table->foreign("business_id")->references("id")->on("businesses")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_wallet');
    }
};
