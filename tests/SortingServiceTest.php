<?php

declare(strict_types=1);

use App\Service\SortingService;
use PHPUnit\Framework\TestCase;

class SortingServiceTest extends TestCase
{

    public function test_invalid_sort_strategy()
    {
        $sorting_service = new SortingService();

        $random_chars = $this->generate_random_chars_in_array();
        $random_string = implode("", $random_chars[0]);

        $this->assertSame(false, $sorting_service->doSort($random_string, "merged_sort"));
        $this->assertSame(false, $sorting_service->doSort($random_string, "quick-sort"));
        $this->assertSame(false, $sorting_service->doSort($random_string, "merge-sort"));
        $this->assertSame(false, $sorting_service->doSort($random_string, "bubble_sort"));
    }

    public function test_empty_string_given()
    {
        $sorting_service = new SortingService();
        $this->assertSame(false, $sorting_service->doSort("    ", "quick_sort"));
        $this->assertSame(false, $sorting_service->doSort("    ", "merge_sort"));
        $this->assertSame(false, $sorting_service->doSort(" ", "quick_sort"));
        $this->assertSame(false, $sorting_service->doSort(" ", "merge_sort"));
        $this->assertSame(false, $sorting_service->doSort("", "quick_sort"));
        $this->assertSame(false, $sorting_service->doSort("", "merge_sort"));
    }

    public function test_sorting_service_using_quick_sort_strategy()
    {
        $sorting_service = new SortingService();

        for ($i = 0; $i <= 50; $i++) {
            $random_chars = $this->generate_random_chars_in_array();
            $random_string = implode("", $random_chars[0]);

            $actual_result = $sorting_service->doSort($random_string, "quick_sort");
            $this->assertSame($random_chars[1], $actual_result);
        }
    }

    public function test_sorting_service_using_merge_sort_strategy()
    {
        $sorting_service = new SortingService();

        for ($i = 0; $i <= 50; $i++) {
            $random_chars = $this->generate_random_chars_in_array();
            $random_string = implode("", $random_chars[0]);

            $actual_result = $sorting_service->doSort($random_string, "merge_sort");
            $this->assertSame($random_chars[1], $actual_result);
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
