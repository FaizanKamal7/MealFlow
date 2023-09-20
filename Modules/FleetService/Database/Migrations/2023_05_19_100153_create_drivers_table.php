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
        Schema::create('drivers', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('license_number')->unique();
            $table->boolean('is_available')->default(true);
            $table->string('license_document')->nullable();
            $table->date('license_issue_date');
            $table->date('license_expiry_date');
            $table->uuid('employee_id');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
