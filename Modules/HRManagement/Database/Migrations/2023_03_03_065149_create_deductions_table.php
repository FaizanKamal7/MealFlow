<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->double("amount");
            $table->string("description")->nullable();
            $table->string("code")->nullable();
            $table->date("date");
            $table->boolean("deducted")->nullable();
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
        Schema::dropIfExists('deductions');
    }
};
