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
        Schema::create('banks', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("bank_name")->nullable();
            $table->string("iban")->nullable();
            $table->string("account_title")->nullable();
            $table->string("account_number")->nullable();
            $table->string("swift_code")->nullable();
            $table->string("sort_code")->nullable();
            $table->string("account_currency")->nullable();
            $table->string("status")->nullable();

            $table->uuid("employee_id");
            $table->timestamps();

            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
};
