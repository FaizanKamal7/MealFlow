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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->double("pay_rate");
            $table->double("deductions")->nullable();
            $table->double("bonus")->nullable();
            $table->double("hours_worked")->nullable();
            $table->double("gross_pay");
            $table->double("tax_withheld");
            $table->double("net_pay");
            $table->date("start_date");
            $table->date("end_date");
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
        Schema::dropIfExists('payrolls');
    }
};
