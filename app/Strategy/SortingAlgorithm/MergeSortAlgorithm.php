<?php

namespace App\Strategy\SortingAlgorithm;

use App\Interface\SortAlgorithm;

class MergeSortAlgorithm implements SortAlgorithm
{

    public function sort(array $array)
    {
        return "merge sort";
    }
}
