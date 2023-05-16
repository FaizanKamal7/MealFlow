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
        Schema::create('leave_policy_records', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("leave_policy_id");
            $table->uuid("leave_type_id");

            $table->double("allowed");
            $table->double("impact_on_pay");
            $table->timestamps();

            $table->foreign("leave_policy_id")->references("id")->on("leave_policies")->onDelete("cascade");
            $table->foreign("leave_type_id")->references("id")->on("leave_types")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_policy_records');
    }
};
