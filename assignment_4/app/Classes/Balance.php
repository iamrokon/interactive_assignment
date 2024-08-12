<?php 
declare(strict_types=1);
namespace App\Classes;
use App\Classes\TransactionType;

class Balance extends Transaction
{
    public function __construct()
    {
        $this->type = TransactionType::BALANCE;
    }
    public static function getModelName(): string
    {
        return 'balances';
    }
}