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
        Schema::create('expense_reclaims', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("title");
            $table->string("currency");
            $table->double("exchange_rate");
            $table->double("amount");
            $table->date("purchase_date");
            $table->string("category")->nullable();
            $table->string("invoice")->nullable();
            $table->string("purchase_from")->nullable();
            $table->date("entry_date");
            $table->string("status")->nullable();
            $table->date("resolution_date")->nullable();
            $table->text("notes")->nullable();

            $table->timestamps();

            $table->uuid("employee_id")->nullable();
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_reclaims');
    }
};
