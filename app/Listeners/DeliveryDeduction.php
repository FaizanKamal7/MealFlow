<?php

namespace App\Listeners;

use App\Events\DeliveryCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;
use Modules\BusinessService\Interfaces\RangePricingInterface;
use Modules\DeliveryService\Interfaces\DeliveryInterface;
use Modules\FinanceService\Interfaces\BusinessWalletInterface;
use Modules\FinanceService\Interfaces\InvoiceItemInterface;

class DeliveryDeduction
{

    protected $deliveryRepository;
    protected $rangePricingRepository;
    protected $deliverySlotPricingRepository;
    protected $invoiceItemRepository;
    protected $businessWalletRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DeliveryInterface $deliveryRepository, RangePricingInterface $rangePricingRepository, DeliverySlotPricingInterface $deliverySlotPricingRepository, InvoiceItemInterface $invoiceItemRepository, BusinessWalletInterface $businessWalletRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->rangePricingRepository = $rangePricingRepository;
        $this->deliverySlotPricingRepository = $deliverySlotPricingRepository;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->businessWalletRepository = $businessWalletRepository;

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DeliveryCompleted  $event
     * @return void
     */
    public function handle(DeliveryCompleted $event)
    {
        Log::info("Delivery completed for ID: {$event->delivery->id}");
        Log::channel('listener')->info("Delivery completed for ID: {$event->delivery->id}");

        $date = date('Y-m-d');
        $delivery_count = $this->deliveryRepository->getDeliveredCountOfDays($event->delivery->branch_id, $date, $date);
        $range_price = $this->rangePricingRepository->getRangePriceOfDelivery($delivery_count, $event->delivery->customerAddress->city_id, $event->delivery->branch->business_id);
        $delivery_slot_price = $this->deliverySlotPricingRepository->getDeliverySlotPriceOfDelivery($event->delivery->delivery_slot_id, $event->delivery->customerAddress->city_id, $event->delivery->branch->business_id);

        $amount_to_deduct = $delivery_slot_price && $range_price ? min($delivery_slot_price->delivery_price, $range_price->delivery_price) : $delivery_slot_price->delivery_price ?? $range_price->delivery_price;
        // $invoice_item = $this->invoiceItemRepository->createInvoiceItem(
        //     item_type: $delivery_slot_price ? InvoiceItemTypeEnum::DELIVERY_SLOT_PRICING->value : InvoiceItemTypeEnum::RANGE_PRICING->value,
        //     amount: $amount_to_deduct,
        //     item_info: $event->delivery,
        //     service: $event->delivery // *Polymorph identification
        // );

         // ----- Updating wallet
         $business_wallet = $this->businessWalletRepository->getBusinessWallet($event->delivery->branch->business_id);
         $this->businessWalletRepository->update($business_wallet->id, ['balance' => $business_wallet->balance - $amount_to_deduct]);
         // $this->businessWalletTransactionRepository->createBusinessWalletTransactions($amount_to_deduct, BusinessWalletTransactionTypeEnum::DEBIT->value, $business_wallet->id, $invoice_item->id);
        
         Log::info("Delivery completed for ID: {$amount_to_deduct}");
       
    }
}
