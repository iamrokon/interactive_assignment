<?php 
declare(strict_types=1);
namespace App\Classes;
use App\Classes\TransactionType;

class CashIn extends Transaction
{
    public function __construct()
    {
        $this->type = TransactionType::CASHIN;
    }
}