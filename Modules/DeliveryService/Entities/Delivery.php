<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;
use HasUuids;
    protected $fillable = [
        "delivery_address",
        "notes",
        "enable_sms_notifications",
        "enable_email_notifications",
        "cod_amount",
        "special_instructions",
        "status",
        "delivery_date",
        "delivered_datetime",
        "item_type",
        "delivery_type",
        "delivery_cost",
        "google_map_link",
        "assignment_type", //auto, manual
        "assigned_at",


        "customer_id",
        "delivery_slot_id", //inherited from partner delivery slots
        "pickup_batch_id",
        "delivery_batch_id",
        "branch_id",
        "bag_id",
        "assigned_by_id",
        "uploaded_by",

    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryFactory::new();
    }
}
