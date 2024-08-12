<?php 
declare(strict_types=1);
namespace App\Classes;

class Transfer implements Model
{
    private $amount;
    private $type;
    private $user_id;
    public $sender_name;
    public $sender_email;
    public $receiver_email;
    public $receiver_name;
    public $time;
    public function __construct()
    {
        $this->type = TransactionType::TRANSFER;
    }
    public static function getModelName(): string
    {
        return 'transfers';
    }
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setUser($id): void
    {
        $this->user_id = $id;
    }

    public function getUser(): int
    {
        return $this->user_id;
    }
}