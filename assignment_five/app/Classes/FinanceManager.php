<?php 
declare(strict_types=1);
namespace App\Classes;

use DateTime;

class FinanceManager
{
    private Storage $storage;
    private array $transactions;
    private array $transfers;
    private array $balances;
    private array $users;
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->transactions = $this->storage->load(Transaction::getModelName());
        $this->transfers = $this->storage->load(Transfer::getModelName());
        $this->balances = $this->storage->load(Balance::getModelName());
        $this->users = $this->storage->load(User::getModelName());
    }
    public function updateBalance($balanceData, $transactionType, $receiver_id = null)
    {
        $balanceExist1 = 0;
        $balanceExist2 = 0;
        foreach($this->balances as $balance){
            if($balance->getUser() == $balanceData->id){
                if($transactionType == TransactionType::CASHIN){
                    $newAmount = $balance->getAmount() + $balanceData->amount;
                }else if($transactionType == TransactionType::CASHOUT || $transactionType == TransactionType::TRANSFER){
                    $newAmount = $balance->getAmount() - $balanceData->amount;
                }
                $balance->amount = $newAmount;
                $balanceExist1 = 1;
            }
            if($balance->getUser() == $receiver_id){
                $newAmount = $balance->getAmount() + $balanceData->amount;
                $balance->amount = $newAmount;
                $balanceExist2 = 1;
            }
        }
        if(!$balanceExist1 || ($receiver_id && !$balanceExist2)){
            $balance = new Balance();
            if($receiver_id){
                $balance->setUser($receiver_id);
            }else{
                $balance->setUser($balanceData->id);
            }
            $balance->setAmount($balanceData->amount);
            $this->balances[] = $balance;
        }
        $this->saveTransaction(Balance::getModelName(), $this->balances);
    }
    public function getTransferData($email = null)
    {
        $transfersById = [];
        if(!$email){
            $email = $_SESSION['email'];
        }
        foreach($this->transfers as $transfer){
            $transferData = [];
            $dateTime = new DateTime($transfer->time);
            $formattedDate = $dateTime->format('d M Y, h:i A');
            if($transfer->email == $email){
                // Cashin
                $transferData['name'] = $transfer->sender_name;
                $transferData['email'] = $transfer->sender_email;
                $transferData['amount'] = "+$".$transfer->getAmount();
                $transferData['time'] = $formattedDate;
                $transfersById[] = $transferData;
            }else if($transfer->sender_email == $email){
                // Cashout
                $transferData['name'] = $transfer->receiver_name;
                $transferData['email'] = $transfer->email;
                $transferData['amount'] = "-$".$transfer->getAmount();
                $transferData['time'] = $formattedDate;
                $transfersById[] = $transferData;
            }
        }
        return $transfersById;
    }
    public function getCustomers()
    {
        return $this->users;
    }
    public function getTransactions()
    {
        return $this->transactions;
    }
    public function getCurrentBalance($id)
    {
        $current_balance = array_filter($this->balances, function($balance) use ($id){
            return $balance->getUser() == $id;
        });
        foreach($current_balance as $balance){
            return $balance;
        }
    }
    public function saveTransaction($model, $transactions): void
    {
        $this->storage->save($model, $transactions);
    }
}
