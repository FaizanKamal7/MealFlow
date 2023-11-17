<?php

namespace App\Listeners;

use App\Events\DeliveryCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;
use App\Enum\BagTypeEnum;
use App\Enum\EmptyBagCollectionStatusEnum;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;

class UploadBagCollection
{

    private $deliveryBagRepository;
    private $emptyBagcollectionRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DeliveryBagInterface $deliveryBagRepository, EmptyBagCollectionInterface $emptyBagCollectionRepository)
    {
        $this->deliveryBagRepository = $deliveryBagRepository;
        $this->emptyBagcollectionRepository = $emptyBagCollectionRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DeliveryCompleted  $event
     * @return void
     */
    public function handle(DeliveryCompleted $event)
    {
        $delivery_bag = $this->deliveryBagRepository->getDeliveryBagOfDelivery($event->delivery->id);

        if ($event->delivery->bag_type == BagTypeEnum::COLLER_BAG->value) {
            $this->emptyBagcollectionRepository->createBagCollection(
                [
                    'status' => EmptyBagCollectionStatusEnum::UNASSIGNED->value,
                    'bag_id' => null,
                    'delivery_id' => $event->delivery->id,
                    'customer_id' => $event->delivery->customer_id,
                    'customer_address_id' => $event->delivery->customer_address_id,
                ]
            );
        }
    }
}
