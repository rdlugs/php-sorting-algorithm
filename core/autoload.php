<?php

spl_autoload_register(function ($class) {
    $split_class = explode('\\', $class);
    $length = count($split_class) - 1;

    $new_class = [];

    foreach ($split_class as $key => $val) {
        $new_class[] = $key !== $length ? strtolower($val) : $val;
    }

    $file = implode('/', $new_class) . '.php';

    if (file_exists($file))
        require_once $file;
});
