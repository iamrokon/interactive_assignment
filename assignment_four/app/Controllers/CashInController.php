<?php 
namespace App\Controllers;
use App\Classes\Storage;
use App\Classes\Transaction;
use App\Classes\TransactionType;
use App\Classes\FinanceManager;
use App\Classes\CashIn;

class CashInController
{
    private array $transactions;
    private Storage $storage;
    private FinanceManager $financeManager;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->financeManager = new FinanceManager($this->storage);
        $this->transactions = $this->storage->load(Transaction::getModelName());
    }
    public function depositBalance($depositData)
    {
        $cashin = new CashIn();
        $cashin->setUser($depositData->id);
        $cashin->setAmount($depositData->amount);
        $cashin->time = date('Y-m-d H:i:s');
        $this->transactions[] = $cashin;
        $this->financeManager->saveTransaction(Transaction::getModelName(), $this->transactions);
        $this->financeManager->updateBalance($depositData,TransactionType::CASHIN);
        flash("success", "Cash deposited successfully.");
    }
    public function getCurrentBalance($id)
    {
        return $this->financeManager->getCurrentBalance($id);
    }
}
?>