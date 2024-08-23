<?php 
declare(strict_types=1);
namespace App\Classes;

class CashOut extends Transaction
{
    public function __construct()
    {
        $this->type = TransactionType::CASHOUT;
    }
}
