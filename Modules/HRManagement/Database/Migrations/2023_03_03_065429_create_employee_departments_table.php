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
        Schema::create('employee_departments', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->boolean("is_manager")->default(false);
            $table->boolean("is_primary")->default(false);
            $table->timestamps();

            $table->uuid("employee_id")->nullable();
            $table->uuid("department_id")->nullable();
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");
            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_departments');
    }
};
