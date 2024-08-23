<?php 
namespace App\Controllers;
use App\Classes\User;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\Balance;
use App\Classes\Transfer;
use App\Classes\FinanceManagerDB;
use App\Classes\StorageType;
use Config;

class TransferController
{
    private $users;
    private array $transactions;
    private array $balances;
    private Storage $storage;
    private array $transfers;
    private $financeManager;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->users = $this->storage->load(User::getModelName());
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $this->financeManager = new FinanceManagerDB($this->storage);
        }else{
            $this->financeManager = new FinanceManager($this->storage);
        }
        $this->transfers = $this->storage->load(Transfer::getModelName());
        $this->transactions = $this->storage->load(Transaction::getModelName());
        $this->balances = $this->storage->load(Balance::getModelName());
    }
    public function transferBalance($transferData)
    {
        $sender_name = "";
        $balance = $this->financeManager->getCurrentBalance($transferData->id);
        $sender_name = $_SESSION['name'];
        $sender_email = $_SESSION['email'];
        if($balance->amount < $transferData->amount){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        if(!$balance){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        $receiver_id = "";
        $receiver_name = "";
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $findBy = "email";
            $user = $this->storage->find(User::getModelName(), $findBy, $transferData->email);
            $receiver_id = $user->id;
            $receiver_name = $user->name;
        }else{
            foreach($this->users as $user){
                if($user->email == $transferData->email){
                    $receiver_id = $user->id;
                    $receiver_name = $user->name;
                }
            }
        }
        if(!$receiver_id){
            flash("msg", "The user is not registered");
            return;
        }
        $transfer = new Transfer();
        $transfer->user_id = $transferData->id;
        $transfer->sender_email = $sender_email;
        $transfer->sender_name = $sender_name;
        $transfer->amount = $transferData->amount;
        $transfer->email = $transferData->email;
        $transfer->receiver_name = $receiver_name;
        $transfer->time = date('Y-m-d H:i:s');
        $this->transfers[] = $transfer;
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $fillable = ['user_id', 'amount', 'email', 'type', 'time'];
            $this->storage->save(Transfer::getModelName(), $transfer, $fillable);
        }else{
            $this->financeManager->saveTransaction(Transfer::getModelName(), $this->transfers);
        }
        $this->financeManager->updateBalance($transferData, TransactionType::TRANSFER, $receiver_id);
        flash("msg", "Balanced transferred successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
    
}
?>