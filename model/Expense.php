<?php
class Expense{
    public function store(string $category, int $amount): void {
        $data = "{$category} - {$amount}\n";
        file_put_contents('data/expenses.txt', $data, FILE_APPEND);
        
        print "Expense Added Successfully";
    }

    public function fetchAll(): array{
        $items = [];
        $lines = file('./data/expenses.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            $items[] = $line;
        }
    
        return $items;
    }
}