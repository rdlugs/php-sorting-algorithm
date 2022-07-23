<?php

namespace App\Service;

use App\Strategy\SortingAlgorithm\MergeSortAlgorithm;
use App\Strategy\SortingAlgorithm\QuickSortAlgorithm;
use App\Strategy\SortStrategy;

class SortingService
{
    private array $registered_algorihtm = [
        'merge_sort',
        'quick_sort'
    ];

    public function doSort(string $string, string $sort_strategy)
    {
        if (!in_array($sort_strategy, $this->registered_algorihtm))
            return;

        $string = str_replace(" ", "", $string);
        if (!$string) return;

        $toBeSorted = array_filter(str_split($string));

        $sort = new SortStrategy(new QuickSortAlgorithm);

        switch ($sort_strategy) {
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
