<?php


namespace App\Controllers;

use Core\BaseController;
use App\Service\SortingService;
use Core\Session;

class SortController extends BaseController
{

    public function index()
    {
        $session = new Session;
        $datas = [];
        if ($session->get('sorted_string')) {
            $datas['sorted_string'] = $session->get('sorted_string');
            $datas['original_string'] = $session->get('original_string');
            $datas['sorting_strategy'] = $session->get('sorting_strategy');
        }

        return $this->view('sort', $datas);
    }

    public function sort()
    {
        $sort_service = new SortingService;
        $result = $sort_service->doSort($_POST['sort_input'], $_POST['sort_strategy']);

        if (!is_array($result))
            return $this->redirect('/');

        $datas = [
            'sorted_string'     => implode('', $result),
            'original_string'   =>  $_POST['sort_input'],
            'sorting_strategy'  => ucwords(str_replace("_", " ", $_POST['sort_strategy'])),
        ];

        return $this->redirect('/', $datas);
    }
}
