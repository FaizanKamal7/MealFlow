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
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('contract_file');
            $table->string('TRN');
            $table->uuid('admin_id');
            $table->uuid('business_category_id');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('set null');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('is_deleted');
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