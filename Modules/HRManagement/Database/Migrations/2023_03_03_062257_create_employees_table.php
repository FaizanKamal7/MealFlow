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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("company_email_address")->nullable();
            $table->string("personal_email_address")->nullable();
            $table->string("company_phone_number")->nullable();
            $table->string("personal_phone_number")->nullable();
            $table->string("picture")->nullable();
            $table->string("city")->nullable();
            $table->string("country")->nullable();
            $table->string("marital_status")->nullable();
            $table->date("hire_date")->nullable();
            $table->date("probation_period_start")->nullable();
            $table->date("probation_period_end")->nullable();
            $table->string("status")->nullable();

            
            // $table->string('experience')->nullable();

            $table->date("contract_start_date")->nullable();
            $table->date("contract_end_date")->nullable();
            $table->time("duty_start_time")->nullable();
            $table->time("duty_end_time")->nullable();


            $table->string("employee_type")->nullable();

            $table->uuid("user_id")->nullable();
            $table->uuid("designation_id")->nullable();
            $table->uuid("leave_policy_id")->nullable();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("set null");
            $table->foreign("designation_id")->references("id")->on("designations")->onDelete("set null");
            $table->foreign("leave_policy_id")->references("id")->on("leave_policies")->onDelete("set null");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
