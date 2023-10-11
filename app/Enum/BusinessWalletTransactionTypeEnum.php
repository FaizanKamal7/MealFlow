<?php

namespace App\Enum;


enum BusinessWalletTransactionTypeEnum: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';
}
