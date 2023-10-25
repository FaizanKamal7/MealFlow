<?php

namespace App\Enum;


enum BusinessWalletTransactionStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
}
