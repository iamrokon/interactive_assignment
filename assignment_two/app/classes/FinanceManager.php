<?php 
class FinanceManager
{
    protected FileStorage $storage;
    public function __construct(FileStorage $storage)
    {
        $this->storage = $storage;
    }
    public function addIncome($amount, $category)
    {
        $data = $amount.PHP_EOL;
        $this->storage->writeToFile('income.txt', $data);
        printf("Income added successfully!\n");
    }
    public function addExpense($amount, $category)
    {
        $data = $amount.PHP_EOL;
        $this->storage->writeToFile('expense.txt', $data);
        printf("Expense added successfully!\n");
    }
    public function showIncomes()
    {
        $data = $this->storage->readFromFile('income.txt');
        $lines = explode(PHP_EOL, trim($data));
        $incomeArray = array_map('floatval', $lines);
        printf("-------------------\n");
        foreach($incomeArray as $income){
            printf("Amount %.2f\n", $income);
        }
        printf("-------------------\n");
    }
    public function showExpenses()
    {
        $data = $this->storage->readFromFile('expense.txt');
        $lines = explode(PHP_EOL, trim($data));
        $expenseArray = array_map('floatval', $lines);
        printf("-------------------\n");
        foreach($expenseArray as $expense){
            printf("Amount %.2f\n", $expense);
        }
        printf("-------------------\n");
    }
    public function showSavings()
    {
        $incomeData = $this->storage->readFromFile('income.txt');
        $incomes = explode(PHP_EOL, trim($incomeData));
        $expenseData = $this->storage->readFromFile('expense.txt');
        $expenses = explode(PHP_EOL, trim($expenseData));
        $total_income = $incomes ? array_sum(array_map('floatval', $incomes)) : 0;
        $total_expense = $expenses ? array_sum(array_map('floatval', $expenses)) : 0;
        $savings = $total_income - $total_expense;
        printf("-------------------\n");
        printf("Amount %.2f\n", $savings);
        printf("-------------------\n");
    }
    public function showCategories()
    {
        $categories = $this->storage->readFromFile('categories.txt');
        printf("-------------------\n");
        printf("%s", $categories);
        printf("-------------------\n");
    }
}