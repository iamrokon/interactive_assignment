<?php 
namespace App\Controllers;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\CashOut;
use App\Classes\Balance;

class CashOutController
{
    private array $transactions;
    private array $balances;
    private Storage $storage;
    private FinanceManager $financeManager;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->financeManager = new FinanceManager($this->storage);
        $this->transactions = $this->storage->load(Transaction::getModelName());
        $this->balances = $this->storage->load(Balance::getModelName());
    }
    public function withdrawBalance($withdrawData)
    {
        $userExist = 0;
        foreach($this->balances as $balance){
            if($balance->getUser() == $withdrawData->id){
                $userExist = 1;
                if($balance->getAmount() < $withdrawData->amount){
                    flash("msg", "You haven't sufficient balance");
                    return;
                }
            }
        }
        if(!$userExist){
            flash("msg", "You haven't sufficient balance");
            return;
        }
        $cashout = new CashOut();
        $cashout->setUser($withdrawData->id);
        $cashout->setAmount($withdrawData->amount);
        $cashout->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashout;
        $this->financeManager->saveTransaction(Transaction::getModelName(), $this->transactions);
        $this->financeManager->updateBalance($withdrawData,TransactionType::CASHOUT);
        flash("msg", "Cash withdraw successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
    
}
?>