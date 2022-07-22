<?php

namespace App\Strategy\SortingAlgorithm;

use App\Interface\SortAlgorithm;

class QuickSortAlgorithm implements SortAlgorithm
{

    public function sort(array $array)
    {
        $auxArray = array_slice($array, 0);

        $this->doQuickSort($auxArray, 0, count($auxArray) - 1);

        return $auxArray;
    }

    private function doQuickSort(array &$auxArray, $low, $high)
    {
        if ($low < $high) {

            $partition = $this->partition($auxArray, $low, $high);
            $this->doQuickSort($auxArray, $low, $partition - 1);
            $this->doQuickSort($auxArray, $partition + 1, $high);
        }
    }

    private function partition(array &$auxArray, $low, $high)
    {
        $pivot = $auxArray[$high];
        $i = $low;

        for ($j = $low; $j < $high; $j++) {

            if ($auxArray[$j] <= $pivot) {

                $temp = $auxArray[$i];
                $auxArray[$i] = $auxArray[$j];
                $auxArray[$j] = $temp;

                $i++;
            }
        }

        $auxArray[$high] = $auxArray[$i];
        $auxArray[$i] = $pivot;

        return $i;
    }
}
