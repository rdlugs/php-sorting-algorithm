<?php

namespace App\Service;

use App\Strategy\SortingAlgorithm\MergeSortAlgorithm;
use App\Strategy\SortingAlgorithm\QuickSortAlgorithm;
use App\Strategy\SortStrategy;

class SortingService
{
    public function doSort(string $string, string $sortStrategy)
    {
        // do not proceed if string is empty
        $string = str_replace(" ", "", $string);
        if (!$string) return;

        // in case, remove empty array elements
        $toBeSorted = array_filter(str_split($string));

        // by default we run quick sort
        $sort = new SortStrategy(new QuickSortAlgorithm);

        switch ($sortStrategy) {
            case 'merge_sort':
                $sort->setStrategy(new MergeSortAlgorithm);
                $result = $sort->doSort($toBeSorted);
                break;

            default:
                $result = $sort->doSort($toBeSorted);
        }

        return $result;
    }
}
