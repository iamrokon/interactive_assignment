<?php 
declare(strict_types=1);
namespace App\Classes;
use App\Classes\User;
use App\Classes\FileStorage;

class Transaction implements Model
{
    protected $type;
    private $user_id;
    private $amount;
    protected $users;
    private $storage;
    public $time;

    public static function getModelName(): string
    {
        return 'transactions';
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount ?? 0;
    }
    public function setUser($id): void
    {
        $this->user_id = $id;
    }

    public function getUser()
    {
        return $this->user_id;
    }
    public function getType()
    {
        return $this->type;
    }
    public function userName()
    {
        $this->storage = new FileStorage();
        $this->users = $this->storage->load(User::getModelName());
        $user = array_filter($this->users, function($user){
            return $user->id == $this->user_id;
        });
        foreach ($user as $item) {
            return $item->name;
        }
    }
}