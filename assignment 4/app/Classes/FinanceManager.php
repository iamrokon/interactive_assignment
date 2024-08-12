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
    public function depositBalance($depositData)
    {
        $cashin = new CashIn();
        $cashin->setUser($depositData->id);
        $cashin->setAmount($depositData->amount);
        $cashin->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashin;
        $this->saveTransaction(Transaction::getModelName(), $this->transactions);
        $this->updateBalance($depositData,TransactionType::CASHIN);
        flash("success", "Cash deposited successfully.");
    }
    public function withdrawBalance($withdrawData)
    {
        $userExist = 0;
        foreach($this->balances as $balance){
            if($balance->getUser() == $withdrawData->id){
                $userExist = 1;
                if($balance->getAmount() < $withdrawData->amount){
                    flash("success", "You haven't sufficient balance");
                    return;
                }
            }
        }
        if(!$userExist){
            flash("success", "You haven't sufficient balance");
            return;
        }
        $cashout = new CashOut();
        $cashout->setUser($withdrawData->id);
        $cashout->setAmount($withdrawData->amount);
        $cashout->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashout;
        $this->saveTransaction(Transaction::getModelName(), $this->transactions);
        $this->updateBalance($withdrawData,TransactionType::CASHOUT);
        flash("success", "Cash withdraw successfully.");
    }
    public function transferBalance($transferData)
    {
        $userExist = 0;
        $sender_name = "";
        foreach($this->balances as $balance){
            if($balance->getUser() == $transferData->id){
                $userExist = 1;
                $sender_name = $_SESSION['name'];
                $sender_email = $_SESSION['email'];
                if($balance->getAmount() < $transferData->amount){
                    flash("success", "You haven't sufficient balance");
                    return;
                }
            }
        }
        if(!$userExist){
            flash("success", "You haven't sufficient balance");
            return;
        }
        $receiver_id = "";
        $receiver_name = "";
        foreach($this->users as $user){
            if($user['email'] == $transferData->email){
                $receiver_id = $user['id'];
                $receiver_name = $user['name'];
            }
        }
        if(!$receiver_id){
            flash("success", "The user is not registered");
            return;
        }
        $transfer = new Transfer();
        $transfer->setUser($transferData->id);
        $transfer->sender_email = $sender_email;
        $transfer->sender_name = $sender_name;
        $transfer->setAmount($transferData->amount);
        $transfer->receiver_email = $transferData->email;
        $transfer->receiver_name = $receiver_name;
        $transfer->time = date('Y-m-d H:i:s');
        $this->transfers[] = $transfer;
        $this->saveTransaction(Transfer::getModelName(), $this->transfers);
        $this->updateBalance($transferData, TransactionType::TRANSFER, $receiver_id);
        flash("success", "Balanced transferred successfully.");
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
                $balance->setAmount($newAmount);
                $balanceExist1 = 1;
            }
            if($balance->getUser() == $receiver_id){
                $newAmount = $balance->getAmount() + $balanceData->amount;
                $balance->setAmount($newAmount);
                $balanceExist2 = 1;
            }
        }
        if(!($balanceExist1 || $balanceExist2)){
            $balance = new Balance();
            $balance->setUser($balanceData->id);
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
            if($transfer->receiver_email == $email){
                // Cashin
                $transferData['name'] = $transfer->sender_name;
                $transferData['email'] = $transfer->sender_email;
                $transferData['amount'] = "+$".$transfer->getAmount();
                $transferData['time'] = $formattedDate;
                $transfersById[] = $transferData;
            }else if($transfer->sender_email == $email){
                // Cashout
                $transferData['name'] = $transfer->receiver_name;
                $transferData['email'] = $transfer->receiver_email;
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
