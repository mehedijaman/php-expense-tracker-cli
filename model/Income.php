<?php 
class Income{
    public function store(string $category, int $amount): void {
        $data = "{$category} - {$amount}\n";
        file_put_contents('data/incomes.txt', $data, FILE_APPEND);

        print "------------------------------------------\n";
        print "Income Added Successfully\n";
        print "------------------------------------------\n";
    }

    public function fetchAll(): array{
        $items = [];
        $lines = file('./data/incomes.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            $items[] = $line;
        }
    
        return $items;
    }

    public function total(): int {
        $total = 0;
        $lines = file('./data/incomes.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            $array = explode('-', $line);
            $total += (int) $array[1];
        }
    
        return $total;
    }
}