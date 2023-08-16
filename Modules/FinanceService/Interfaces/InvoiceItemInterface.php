<?php

namespace Modules\FinanceService\Interfaces;

interface InvoiceItemInterface {
    public function createInvoiceItem($item_id,$item_type,$amount,$invoice_id);
    public function getInvoiceItem($id);
    public function deleteInvoiceItem($id);
}