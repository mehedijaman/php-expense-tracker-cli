<?php 
require_once './model/Income.php';
require_once './model/Expense.php';
require_once './model/Category.php';

class ConsoleApp{

    private const ADD_INCOME = 1;
    private const ADD_EXPENSE = 2;
    private const ADD_CATEGORY = 3;
    private const VIEW_INCOME = 4;
    private const VIEW_EXPENSE = 5;
    private const VIEW_CATEGORY = 6;
    private const RIP = 7;
    private const EXIT = 0;

    private array $options = [
        self::ADD_INCOME => 'Add Income',
        self::ADD_EXPENSE => 'Add Expense',
        self::ADD_CATEGORY => 'Add Category',
        self::VIEW_INCOME => 'View Income',
        self::VIEW_EXPENSE => 'View Expense',
        self::VIEW_CATEGORY => 'View Category',
        self::RIP => 'Rest In Pocket(RIP)',
        self::EXIT => 'Exit'
    ];

    public function __construct(){

    }

    public function run(): void{
        while(true){
            $this->showOptions();
            $choice = (int) readline("Enter your choice: ");
            switch($choice){
                case self::ADD_INCOME:
                    $this->addIncome();
                    break;
                case self::ADD_EXPENSE:
                    $this->addExpense();
                    break;
                case self::VIEW_INCOME:
                    $this->viewIncomes();
                    break;
                case self::VIEW_EXPENSE:
                    $this->viewExpenses();
                    break;
                case self::ADD_CATEGORY:
                    $this->addCategory();
                    break;
                case self::VIEW_CATEGORY:
                    $this->viewCategories();
                    break;
                case self::RIP:
                    $this->restInPocket();
                    break;
                case self::EXIT:
                    exit(0);
                default:
                    print "Invalid choice. Please select correct option\n";
                    break;                    
            }
        }
    }

    public function showOptions(): void{
        print "PHP Expense Tracker CLI App\n";
        foreach($this->options as $key => $value){
            print $key.' '. $value.'\n';
        }
        print "================================\n";
    }

    public function addIncome(): void{
        $input = readline('Enter Income (Format:: Category-Amount): ');
        $input = explode('-', $input);
        $category = $input[0];
        $amount = (int) $input[1];

        $income = new Income();       
        $income->store($category, $amount);
    }

    public function addExpense(): void{
        $input = readline('Enter Expense (Format:: Category-Amount): ');
        $input = explode('-', $input);
        $category = $input[0];
        $amount = (int) $input[1];

        $income = new Expense();       
        $income->store($category, $amount);
    }

    public function viewIncomes(): void{
        $obj = new Income();
        $incomes = $obj->fetchAll();
        $total = $obj->total();

        print "------------ Income List -----------------\n";
        foreach ($incomes as $income){
            print $income.PHP_EOL;
        }
        print "--------- Total Income = {$total} ---------\n";
    }

    public function viewExpenses(): void{
        $obj = new Expense();
        $expenses = $obj->fetchAll();
        $total = $obj->total();
        print "------------ Expense List -----------------\n";
        foreach ($expenses as $expense){
            print $expense.PHP_EOL;
        }
        print "-------- Total Expense = {$total} ----------\n";
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

    public function restInPocket() : void {
        $objIncome = new Income();
        $totalIncome = $objIncome->total();

        $objExpense = new Expense();
        $totalExpense = $objExpense->total();

        $RIP = $totalIncome - $totalExpense;

        print "------------------------------------------\n";
        print "Rest in Pocket (RIP): {$RIP}\n";
        print "------------------------------------------\n";
    }
}