<?php
declare(strict_types=1);
namespace App\Classes;
class TransactionType
{
    const CASHIN = 'cashin';
    const CASHOUT = 'cashout';
    const TRANSFER = 'transfer';
    const BALANCE = 'balance';
}