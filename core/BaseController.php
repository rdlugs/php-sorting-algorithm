<?php

namespace Core;

class BaseController
{

    public function view($file_path, array $data = [])
    {
        extract($data);

        if (file_exists(BASE_DIR . '/app/views/' . $file_path . '.php')) {
            require_once BASE_DIR . '/app/views/' . $file_path . '.php';
        } else {
            HttpError::PageNotFound();
        }
    }
}