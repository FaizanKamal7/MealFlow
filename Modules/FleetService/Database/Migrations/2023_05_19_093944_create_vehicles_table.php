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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("api_unit_id")->nullable();
            $table->string("registration_number");
            $table->string("vehicle_picture")->nullable();
            
            $table->string("engine_number")->nullable();
            $table->string("chassis_number")->nullable();

            
            $table->string("year")->nullable();
            $table->string("color")->nullable();
            $table->string("qr_code")->nullable();
            
            $table->string("insurance_picture")->nullable();
            $table->date("insurance_issue_date")->nullable();
            $table->date("insurance_expiry_date")->nullable();

            $table->string("municipality_picture")->nullable();
            $table->date("municipality_issue_date")->nullable();
            $table->date("municipality_expiry_date")->nullable();

            $table->string("registration_picture")->nullable();
            $table->date("registration_issue_date")->nullable();
            $table->date("registration_expiry_date")->nullable();

            $table->string('status')->default('available');
            $table->integer('mileage')->default(0);

            $table->uuid("vehicle_type_id")->nullable();
            $table->uuid("vehicle_model_id")->nullable();
            $table->foreign("vehicle_type_id")->references("id")->on("vehicle_types")->onDelete("set null");
            $table->foreign("vehicle_model_id")->references("id")->on("vehicle_models")->onDelete("set null");
            
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
        Schema::dropIfExists('vehicles');
    }
};
