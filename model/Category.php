<?php
class Category{
    public function store(string $name): void{
        $data = "{$name}\n";
        file_put_contents('data/categories.txt', $data, FILE_APPEND);
        
        print "Category Added Successfully";
    }

    public function fetchAll(): array{
        $items = [];
        $lines = file('./data/categories.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            $items[] = $line;
        }
    
        return $items;
    }
}