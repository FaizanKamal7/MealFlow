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
            $table->uuid('admin_id');
            $table->uuid('business_category_id');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        // Schema::table('businesses', function ($table) {
        //     $table->uuid('admin_id')->change();
        //     $table->uuid('business_category_id')->change();
        // });
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
