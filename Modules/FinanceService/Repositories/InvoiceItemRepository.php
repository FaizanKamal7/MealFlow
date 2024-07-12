<?php

namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\InvoiceItem;
use Modules\FinanceService\Interfaces\InvoiceItemInterface;

class InvoiceItemRepository implements InvoiceItemInterface
{
    public function createInvoiceItem($item_type, $amount, $item_info, $service)
    {
        $invoiceItem =  new InvoiceItem([
            'item_type' => $item_type,
            'amount' => $amount,
            'item_info' => $item_info,
        ]);
        $invoiceItem->service()->associate($service);
        $invoiceItem->save();
        return  $invoiceItem;
    }

    public function getInvoiceItem($id)
    {
        return InvoiceItem::find($id);
    }

    public function deleteInvoiceItem($id)
    {
        return InvoiceItem::find($id)->delete();
    }
}
