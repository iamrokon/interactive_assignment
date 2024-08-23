<?php 
namespace App\Controllers;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\CashIn;
use App\Classes\FinanceManagerDB;
use App\Classes\StorageType;
use Config;

class CashInController
{
    private array $transactions;
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
    }
    public function depositBalance($depositData)
    {
        $cashin = new CashIn();
        $cashin->user_id = $depositData->id;
        $cashin->amount = $depositData->amount;
        $cashin->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashin;
        if(Config::CURRENT_STORAGE == StorageType::DATABASE){
            $fillable = ['user_id', 'amount', 'type', 'time'];
            $this->storage->save(Transaction::getModelName(), $cashin, $fillable);
        }else{
            $this->financeManager->saveTransaction(Transaction::getModelName(), $this->transactions);
        }
        $this->financeManager->updateBalance($depositData,TransactionType::CASHIN);
        flash("success", "Cash deposited successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
}
?>