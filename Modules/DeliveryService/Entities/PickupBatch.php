<?php

namespace Modules\DeliveryService\Entities;

use App\Enum\BatchStatusEnum;
use App\Http\Helper\Helper;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class PickupBatch extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "batch_start_time",
        "batch_end_time",
        "batch_start_map_coordinates",
        "batch_end_map_coordinates",
        "status",
        "vehicle_id",
        "driver_id",
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function pickupBatchBranches()
    {
        return $this->hasMany(PickupBatchBranch::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\PickupBatchFactory::new();
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function ($model) {
            $helper = new Helper();
            $user_id = auth()->id();
            $module_name = "DeliveryService";
            $action = "Created";
            $subject = "New Record Created";
            $url = Request::fullUrl();
            $description = "A New Record has been created";
            $ip_address = Request::ip();
            $user_agent = Request::header('user-agent');
            $old_values = null;
            $new_values = json_encode(json_encode($model->getAttributes()));
            $record_id = $model->id;
            $record_type = get_class($model);
            $method = Request::method();

            $helper->logActivity(
                userId: $user_id,
                moduleName: $module_name,
                action: $action,
                subject: $subject,
                url: $url,
                description: $description,
                ipAddress: $ip_address,
                userAgent: $user_agent,
                oldValues: $old_values,
                newValues: $new_values,
                recordId: $record_id,
                recordType: $record_type,
                method: $method
            );
        });

        static::updating(function ($model) {
            $changes = $model->getDirty();

            if ($changes) {
                $helper = new Helper();
                $user_id = auth()->id();
                $module_name = "DeliveryService";
                $action = "Updated";
                $subject = "Record Updated";
                $url = Request::fullUrl();
                $description = "Record has been updated";
                $ip_address = Request::ip();
                $user_agent = Request::header('user-agent');
                $old_values = json_encode(json_encode($model->getOriginal()));
                $new_values = json_encode($model->getAttributes());
                $record_id = $model->id;
                $record_type = get_class($model);
                $method = Request::method();

                $helper->logActivity(
                    userId: $user_id,
                    moduleName: $module_name,
                    action: $action,
                    subject: $subject,
                    url: $url,
                    description: $description,
                    ipAddress: $ip_address,
                    userAgent: $user_agent,
                    oldValues: $old_values,
                    newValues: $new_values,
                    recordId: $record_id,
                    recordType: $record_type,
                    method: $method
                );
            }
        });

        static::updated(function ($model) {
            $changes = $model->getDirty();

            // Check if 'balance' attribute is being updated
            if ($model->isDirty('status')) {
                $attributes = $model->getAttributes();
                $id = $attributes['id'];
                $status = $attributes['status'];

                if ($status == BatchStatusEnum::ENDED) {

                    // foreach ($variable as $key => $value) {
                    //     # code...
                    // }
                }
                // dd($attributes);
                // // Compare old balance with new balance
                // if ($newBalance > $oldBalance) {
                //     $helper->businessWalletTransactions($amount, BusinessWalletTransactionTypeEnum::CREDIT, $wallet_id, $payment_method_id = null, $card_id = null);
                // } else {
                //     $helper->businessWalletTransactions($amount, BusinessWalletTransactionTypeEnum::DEBIT, $wallet_id, $invoice_item_id  = null);
                // }
            }
        });


        static::deleting(function ($model) {
            $helper = new Helper();
            $user_id = auth()->id();
            $module_name = "DeliveryService";
            $action = "Deleted";
            $subject = "Record Deleted";
            $url = Request::fullUrl();
            $description = "Record has been Deleted";
            $ip_address = Request::ip();
            $user_agent = Request::header('user-agent');
            $old_values = json_encode($model->getOriginal());
            $new_values = null;
            $record_id = $model->id;
            $record_type = get_class($model);
            $method = Request::method();
            $helper->logActivity(
                userId: $user_id,
                moduleName: $module_name,
                action: $action,
                subject: $subject,
                url: $url,
                description: $description,
                ipAddress: $ip_address,
                userAgent: $user_agent,
                oldValues: $old_values,
                newValues: $new_values,
                recordId: $record_id,
                recordType: $record_type,
                method: $method
            );
        });
    }
}
