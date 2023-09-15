<?php

namespace Modules\DeliveryService\Entities;

use App\Models\DeliverySlot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\BusinessService\Entities\Branch;
use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Entities\CustomerAddress;

class Delivery extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "status",
        "is_recurring",
        "payment_status",
        "is_sign_required",
        "is_notification_enabled",
        "note",
        "branch_id",
        "delivery_slot_id",
        "delivery_type_id",
        "customer_id",
        "customer_address_id",
        "pick_up_batch_id",
        "delivery_batch_id",
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function deliverySlot()
    {
        return $this->belongsTo(DeliverySlot::class, 'delivery_slot_id');
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class, 'delivery_type_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function customerAddress()
    {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }

    public function pickupBatch()
    {
        return $this->belongsTo(PickupBatch::class, 'pick_up_batch_id');
    }

    public function deliveryBatch()
    {
        return $this->belongsTo(DeliveryBatch::class, 'delivery_batch_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryFactory::new();
    }
}
