<?php

namespace App\Strategy\SortingAlgorithm;

use App\Interface\SortAlgorithm;

class MergeSortAlgorithm implements SortAlgorithm
{

    public function sort(array $array)
    {

        if (count($array) <= 1) return $array;

        return $this->doMergeSort($array);
    }

    public function doMergeSort(array $array)
    {
        $array_length = count($array);

        if ($array_length <= 1) return $array;

        $midIdx = round($array_length / 2);

        $left_array = array_slice($array, 0, $midIdx);
        $left_array = $this->doMergeSort($left_array);

        $right_array = array_slice($array, $midIdx);
        $right_array = $this->doMergeSort($right_array);

        return $this->merge($left_array, $right_array);
    }

    public function merge(array $left_array, array $right_array)
    {
        $merged_array = [];

        while (!empty($left_array) || !empty($right_array)) {

            // both left and right has value
            if (!empty($left_array) && !empty($right_array)) {

                $merged_array[] = ($left_array[0] > $right_array[0])
                    ? array_shift($right_array)
                    : array_shift($left_array);

                // left or right has excess values
            } elseif (empty($left_array) || empty($right_array)) {

                $merged_array[] = empty($right_array)
                    ? array_shift($left_array)
                    : array_shift($right_array);
            }
        }


        return $merged_array;
    }
}
