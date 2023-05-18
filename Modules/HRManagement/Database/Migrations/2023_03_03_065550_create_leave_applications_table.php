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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("duration");
            $table->date("start_date");
            $table->date("end_date");
            $table->text("description")->nullable();
            $table->string("status")->default("pending");
            $table->string("attachment")->nullable();
            $table->double("consumed");
            $table->double("impact_on_pay");

            $table->uuid("leave_policy_record_id")->nullable();
            $table->uuid("employee_id")->nullable();

            $table->timestamps();

            $table->foreign("leave_policy_record_id")->references("id")->on("leave_policy_records")->onDelete("set null");
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
        Schema::dropIfExists('leave_applications');
    }
};
