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
    public $email;
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
    public function __set($name, $value)
    {
        if(property_exists($this, $name)){
            $this->$name = $value;
        }
    }
    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }
    // public function setAmount($amount): void
    // {
    //     $this->amount = $amount;
    // }
    public function getAmount()
    {
        return $this->amount;
    }
    // public function setUser($id): void
    // {
    //     $this->user_id = $id;
    // }

    public function getUser(): int
    {
        return $this->user_id;
    }
}