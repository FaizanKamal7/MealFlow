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
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name')->unique();
            $table->string('contract_file')->nullable();
            $table->string('TRN')->nullable();
            $table->string('logo')->nullable();
            $table->string('status');
            $table->boolean('active_status')->nullable();
            $table->uuid('admin_id')->nullable();
            $table->uuid('business_category_id')->nullable();;
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('set null');
            $table->softDeletes();
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
        Schema::dropIfExists('businesses');
    }
};
