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

    public function redirect($url, $data = [])
    {
        if (count($data) > 0) {
            $session = new Session;
            foreach ($data as $key => $value) {
                $session->flash($key, $value);
            }
        }

        header('Cache-Control: no-cache');
        header('Location: ' . $url, true, 302);
        exit();
    }
}
