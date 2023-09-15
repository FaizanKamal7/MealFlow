<?php

namespace Modules\DeliveryService\Jobs;

use App\Http\Helper\Helper;
use App\Interfaces\AreaInterface;
use App\Interfaces\CityInterface;
use App\Interfaces\DeliverySlotInterface;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Modules\BusinessService\Interfaces\CustomerAddressInterface;
use Modules\BusinessService\Interfaces\CustomerInterface;
use Modules\DeliveryService\Entities\Delivery;

class UploadDeliveriesCSVJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    protected $failedRecords = [];

    public function __construct(
        $data,
    ) {

        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $delivery_data) {
            // Validate the data here
            if ($delivery_data) {
                Delivery::create($delivery_data);
            } else {
                $this->failedRecords[] = $delivery_data;
            }
        }



        // After processing, you can store failed records in a file or database
        if (!empty($this->failedRecords)) {
            $this->storeFailedRecords($this->failedRecords);
        }
    }




    // Store failed records (you can customize this)
    // private function storeFailedRecords($failedRecords)
    // {
    //     // Example: Store failed records in a JSON file
    //     $failedRecordsJson = json_encode($failedRecords);
    //     file_put_contents(storage_path('failed_records.json'), $failedRecordsJson);
    // }
    private function storeFailedRecord($failedData)
    {
        DB::table('failed_deliveries')->insert([
            'data' => json_encode($failedData),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Thsingle_dataable $exception): void
    {
        // Send user notification of failure, etc...
    }
}
