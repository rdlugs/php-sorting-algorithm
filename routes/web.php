<?php

use App\Controllers\SortController;

$router->get('/', [SortController::class, 'index']);
$router->post('/sort', [SortController::class, 'sort']);
