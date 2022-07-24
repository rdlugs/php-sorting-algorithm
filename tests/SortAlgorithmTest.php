<?php

declare(strict_types=1);

use App\Strategy\SortingAlgorithm\MergeSortAlgorithm;
use App\Strategy\SortingAlgorithm\QuickSortAlgorithm;
use PHPUnit\Framework\TestCase;

class SortAlgorithmTest extends TestCase
{
    public function test_quick_sort_algorithm()
    {
        $quick_sort = new QuickSortAlgorithm();

        for ($i = 0; $i <= 50; $i++) {
            $random_chars = $this->generate_random_chars_in_array(20);
            $this->assertSame($random_chars[1], $quick_sort->sort($random_chars[0]));
        }
    }

    public function test_merge_sort_algorithm()
    {
        $merge_sort = new MergeSortAlgorithm();
        for ($i = 0; $i <= 50; $i++) {
            $random_chars = $this->generate_random_chars_in_array(20);
            $this->assertSame($random_chars[1], $merge_sort->sort($random_chars[0]));
        }
    }

    public function generate_random_chars_in_array(int $length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        $random_string = '';

        for ($i = 0; $i < $length; $i++)
            $random_string .= $characters[rand(0, $characters_length - 1)];


        $array_chars = str_split($random_string);
        $expected_output = str_split($random_string);
        sort($expected_output);

        return [$array_chars, $expected_output];
    }
}
