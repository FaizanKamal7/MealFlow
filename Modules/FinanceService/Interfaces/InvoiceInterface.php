<?php

namespace Modules\FinanceService\Interfaces;

interface InvoiceInterface{
    
    public function createInvoice($start_date,$end_date,$invoice_date,$total_amount,$paid_amount,$status,$paid_date,$payment_method,$is_sent,$business_id);
    public function getInvoice($id);
    public function deleteInvoice($id);

}