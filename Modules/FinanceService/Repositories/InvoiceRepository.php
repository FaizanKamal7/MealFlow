<?php
namespace Modules\FinanceService\Repositories;

use Modules\FinanceService\Entities\Invoice;
use Modules\FinanceService\Interfaces\InvoiceInterface;

class InvoiceRepository implements InvoiceInterface
{
    public function createInvoice($start_date,$end_date,$invoice_date,$total_amount,$paid_amount,$status,$paid_date,$payment_method,$is_sent,$business_id)
    {
        return Invoice::create([
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            'invoice_date'=> $invoice_date,
            'total_amount'=> $total_amount,
            'paid_amount'=> $paid_amount,
            'status'=> $status,
            'paid_date'=> $paid_date,
            'payment_method'=> $payment_method,
            'is_sent'=> $is_sent,
            'business_id'=> $business_id,
        ]);
    }
    public function getInvoice($id)
    {
        return Invoice::find($id);
    }
    public function deleteInvoice($id)
    {
        return Invoice::find($id)->delete();

    }
}