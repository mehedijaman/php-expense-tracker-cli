<?php 
require_once './model/Income.php';
require_once './model/Expense.php';
require_once './model/Category.php';

class ExpenseTracker{
    public function run(){
        while(true){
            $this->showOptions();
            $choice = (int) readline("Enter your choice: ");
            switch($choice){
                case 1:
                    $this->addIncome();
                    break;
                case 2:
                    $this->addExpense();
                    break;
                case 3:
                    $this->viewIncomes();
                    break;
                case 4:
                    $this->viewExpenses();
                    break;
                case 5:
                    $this->addCategory();
                    break;
                case 6:
                    $this->viewCategories();
                    break;
                case 7:
                    exit(0);
                default:
                    print "Invalid choice. Please select correct option";
                    break;                    
            }
        }
    }

    public function showOptions(): void{
        print "PHP Expense Tracker CLI App\n";
        print "================================\n";
        print "1. Add Income\n";
        print "2. Add Expense\n";
        print "3. View Incomes\n";
        print "4. View Expenses\n";
        print "5. Add Category\n";
        print "6. View Categories\n";
        print "7. Exit\n";
        print "================================\n";
    }

    public function addIncome(): void{
        $input = readline('Enter Income (Format:: Category-Amount): ');
        $input = explode('-', $input);
        $category = $input[0];
        $amount = $input[1];

        $income = new Income();       
        $income->store($category, $amount);
    }

    public function addExpense(): void{
        $input = readline('Enter Expense (Format:: Category-Amount): ');
        $input = explode('-', $input);
        $category = $input[0];
        $amount = $input[1];

        $income = new Expense();       
        $income->store($category, $amount);
    }

    public function viewIncomes(): void{
        $obj = new Income();
        $incomes = $obj->fetchAll();
        print "------------ Income List -----------------\n";
        foreach ($incomes as $income){
            print $income.PHP_EOL;
        }
        print "------------------------------------------\n";
    }

    public function viewExpenses(): void{
        $obj = new Expense();
        $expenses = $obj->fetchAll();
        print "------------ Expense List -----------------\n";
        foreach ($expenses as $expense){
            print $expense.PHP_EOL;
        }
        print "------------------------------------------\n";
    }

    public function addCategory(): void{
        $input = readline('Enter a Category Name: ');
        $category = new Category();
        $category->store($input);
    }

    public function viewCategories(): void{
        $obj = new Category();
        $categories = $obj->fetchAll();
        print "------------ Category List -----------------\n";
        foreach ($categories as $category){
            print $category.PHP_EOL;
        }
        print "------------------------------------------\n";
    }
}