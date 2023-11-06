<?php

namespace Modules\FinanceService\Interfaces;

interface InvoiceItemInterface
{
    public function createInvoiceItem($item_type, $amount, $item_info, $service);
    public function getInvoiceItem($id);
    public function deleteInvoiceItem($id);
}
