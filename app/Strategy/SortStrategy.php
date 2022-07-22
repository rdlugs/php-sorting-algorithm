<?php

namespace App\Strategy;

use App\Interface\SortAlgorithm;

class SortStrategy
{

    private $strategy;

    public function __construct(SortAlgorithm $strategy)
    {
        $this->setStrategy($strategy);
    }

    public function setStrategy(SortAlgorithm $strategy)
    {
        $this->strategy = $strategy;
    }

    public function doSort(array $array)
    {
        return $this->strategy->sort($array);
    }
}
