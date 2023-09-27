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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("status");
            $table->boolean("is_recurring");
            $table->boolean("is_notification_enabled")->nullable();
            $table->string("payment_status");
            $table->boolean("is_sign_required")->nullable();
            $table->string("note")->nullable();
            $table->date("delivery_date");
            $table->uuid("branch_id")->nullable();
            $table->uuid("delivery_slot_id")->nullable();
            $table->uuid("delivery_type_id")->nullable();
            $table->uuid("customer_id")->nullable();
            $table->uuid("customer_address_id")->nullable();
            $table->uuid("pickup_batch_id")->nullable();
            $table->uuid("delivery_batch_id")->nullable();
            $table->foreign("branch_id")->references("id")->on("branches")->onDelete("set null");
            $table->foreign("delivery_slot_id")->references("id")->on("delivery_slots")->onDelete("set null");
            $table->foreign("delivery_type_id")->references("id")->on("delivery_types")->onDelete("set null");
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("set null");
            $table->foreign("customer_address_id")->references("id")->on("customer_addresses")->onDelete("set null");
            $table->foreign("pickup_batch_id")->references("id")->on("pickup_batches")->onDelete("set null");
            $table->foreign("delivery_batch_id")->references("id")->on("delivery_batches")->onDelete("set null");
            $table->timestamps();
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
        Schema::dropIfExists('deliveries');
    }
};
