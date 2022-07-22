<?php

namespace Core;


class HttpError
{
    public static function error404()
    {
        http_response_code(404);
        $custom_view_404 = 'app/views/404.php';

        if (file_exists($custom_view_404)) {
            require_once $custom_view_404;
        } else {
            echo "<h1>Error 404</h1>";
        }
    }

    public static function PageNotFound()
    {
        http_response_code(404);
        $custom_view_404 = 'app/views/404.php';

        if (file_exists($custom_view_404)) {
            require_once $custom_view_404;
        } else {
            echo "<h1>Page Not Found</h1>";
        }
    }
}
