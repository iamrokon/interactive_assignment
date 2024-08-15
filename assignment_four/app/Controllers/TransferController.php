<?php 
namespace App\Controllers;
use App\Classes\User;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\Balance;
use App\Classes\Transfer;

class TransferController
{
    private $users;
    private array $transactions;
    private array $balances;
    private Storage $storage;
    private array $transfers;
    private FinanceManager $financeManager;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->users = $this->storage->load(User::getModelName());
        $this->financeManager = new FinanceManager($this->storage);
        $this->transfers = $this->storage->load(Transfer::getModelName());
        $this->transactions = $this->storage->load(Transaction::getModelName());
        $this->balances = $this->storage->load(Balance::getModelName());
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
                    flash("msg", "You haven't sufficient balance");
                    return;
                }
            }
        }
        if(!$userExist){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        $receiver_id = "";
        $receiver_name = "";
        foreach($this->users as $user){
            if($user->email == $transferData->email){
                $receiver_id = $user->id;
                $receiver_name = $user->name;
            }
        }
        if(!$receiver_id){
            flash("msg", "The user is not registered");
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
        $this->financeManager->saveTransaction(Transfer::getModelName(), $this->transfers);
        $this->financeManager->updateBalance($transferData, TransactionType::TRANSFER, $receiver_id);
        flash("msg", "Balanced transferred successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
    
}
?>