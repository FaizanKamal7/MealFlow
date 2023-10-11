<?php

namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\InvoiceItem;
use Modules\FinanceService\Interfaces\InvoiceItemInterface;

class InvoiceItemRepository implements InvoiceItemInterface
{
    public function createInvoiceItem($item_id, $item_type, $amount, $invoice_id)
    {
        return InvoiceItem::create([
            'item_type' => $item_type,
            'item_id' => $item_id,
            'amount' => $amount,
            'invoice_id' => $invoice_id,
        ]);
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
