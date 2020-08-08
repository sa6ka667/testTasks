<?php
class First {
    public function getClassname()
    {
        return static::class;
    }
    public function getLetter()
    {
        return 'A';
    }
}

class Second extends First{
    public function getLetter()
    {
        return 'B';
    }
}

$first = new First();
$second= new Second();

echo "First: {$first->getClassname()}\n";
echo "Second: {$second->getClassname()}\n";
echo "A: {$first->getLetter()}\n";
echo "B: {$second->getLetter()}";