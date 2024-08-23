<?php 
declare(strict_types=1);
namespace App\Classes;

use DateTime;
use Database;

class FinanceManagerDB
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
        $findBy = "user_id";
        $balance = $this->storage->find(Balance::getModelName(), $findBy, $balanceData->id);
        $fillable = ['amount'];
        if($balance){
            if($transactionType == TransactionType::CASHIN){
                $newAmount = $balance->amount + $balanceData->amount;
            }else if($transactionType == TransactionType::CASHOUT || $transactionType == TransactionType::TRANSFER){
                $newAmount = $balance->amount - $balanceData->amount;
            }
            $balance->amount = $newAmount;
            $this->storage->update(Balance::getModelName(), $balance, $fillable, $findBy, $balanceData->id);
            $balanceExist1 = 1;
        }
        if($receiver_id){
            $receiver_balance = $this->storage->find(Balance::getModelName(), $findBy, $receiver_id);
            $newAmount = ($receiver_balance ? $receiver_balance->amount : 0) + $balanceData->amount;
            if($receiver_balance){
                $receiver_balance->amount = $newAmount;
                $this->storage->update(Balance::getModelName(), $receiver_balance, $fillable, $findBy, $receiver_id);
                $balanceExist2 = 1;
            }
        }
        if(!$balanceExist1 || !$balanceExist2){
            $balance = new Balance();
            if($receiver_id){
                $balance->user_id = $receiver_id;
            }else{
                $balance->user_id = $balanceData->id;
            }
            $balance->amount = $balanceData->amount;
            $balance->time = date('Y-m-d H:i:s');
            $fillable = ['user_id', 'amount', 'type', 'time'];
            $this->storage->save(Balance::getModelName(), $balance, $fillable);
        }
    }
    public function getTransferData($email = null)
    {
        $transfersById = [];
        if(!$email){
            $email = $_SESSION['email'];
        }
        $findByQuery = "sender_email = '$email' or receiver_email = '$email'";
        $transfers = $this->storage->findByQuery('v_transfer', $findByQuery);
        foreach($transfers as $transfer){
            $transferData = [];
            $dateTime = new DateTime($transfer->time);
            $formattedDate = $dateTime->format('d M Y, h:i A');
            if($transfer->receiver_email == $email){
                // Cashin
                $transferData['name'] = $transfer->sender_name;
                $transferData['email'] = $transfer->sender_email;
                $transferData['amount'] = "+$".$transfer->amount;
                $transferData['time'] = $formattedDate;
                $transfersById[] = $transferData;
            }else if($transfer->sender_email == $email){
                // Cashout
                $transferData['name'] = $transfer->receiver_name;
                $transferData['email'] = $transfer->receiver_email;
                $transferData['amount'] = "-$".$transfer->amount;
                $transferData['time'] = $formattedDate;
                $transfersById[] = $transferData;
            }
        }
        return $transfersById;
    }
    public function getCustomers()
    {
        $users = $this->storage->load(User::getModelName());
        return $users;
    }
    public function getTransactions()
    {
        $tableName = 'v_transactions';
        $transactions = $this->storage->load($tableName);
        return $transactions;
    }
    public function getCurrentBalance($id)
    {
        $findBy = "user_id";
        $balance = $this->storage->find(Balance::getModelName(), $findBy, $id);
        return $balance;
    }
    public function saveTransaction($model, $transactions): void
    {
        $this->storage->save($model, $transactions);
    }
}
