<?php 
namespace App\Controllers;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\FinanceManagerDB;
use App\Classes\CashOut;
use App\Classes\Balance;
use App\Classes\StorageType;
use Config;

class CashOutController
{
    private array $transactions;
    private array $balances;
    private Storage $storage;
    private $financeManager;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $this->financeManager = new FinanceManagerDB($this->storage);
        }else{
            $this->financeManager = new FinanceManager($this->storage);
        }
        $this->transactions = $this->storage->load(Transaction::getModelName());
        $this->balances = $this->storage->load(Balance::getModelName());
    }
    public function withdrawBalance($withdrawData)
    {
        $balance = $this->financeManager->getCurrentBalance($withdrawData->id);
    
        if($balance->amount < $withdrawData->amount){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        if(!$balance){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        $cashout = new CashOut();
        $cashout->user_id = $withdrawData->id;
        $cashout->amount = $withdrawData->amount;
        $cashout->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashout;
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $fillable = ['user_id', 'amount', 'type', 'time'];
            $this->storage->save(Transaction::getModelName(), $cashout, $fillable);
        }else{
            $this->financeManager->saveTransaction(Transaction::getModelName(), $this->transactions);
        }
        $this->financeManager->updateBalance($withdrawData,TransactionType::CASHOUT);
        flash("msg", "Cash withdraw successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
    
}
?>