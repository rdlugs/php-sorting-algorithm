<?php


namespace App\Controllers;

use Core\BaseController;
use App\Service\SortingService;

class SortController extends BaseController
{

    public function index()
    {
        $datas = [];
        $session = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;

        if ($session) {
            $datas['sorted_string'] = $session ? $session['sorted_string'] : null;
            $datas['original_string'] = $session ? $session['original_string'] : null;
            $datas['sorting_strategy'] = $session ? $session['sorting_strategy'] : null;
        }

        return $this->view('sort', $datas);
    }

    public function sort()
    {
        $sort = new SortingService;
        $result = $sort->doSort($_POST['sort_input'], $_POST['sort_strategy']);

        if (!is_array($result)) {
            return $this->redirect('/');
        }

        $_SESSION['flash'] = [
            'sorted_string'     => implode('', $result),
            'original_string'   => $_POST['sort_input'],
            'sorting_strategy'  => ucwords(str_replace("_", " ", $_POST['sort_strategy'])),
        ];

        return $this->redirect('/');
    }
}
