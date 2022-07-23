<?php


namespace Core;

use Exception;
use ReflectionClass;

class Router
{
    private $registered_routes = [];
    private $controllers = [];
    private $parameters = [];
    private $session;

    public function __construct()
    {
        $this->session = new Session;
    }

    public function get($route, $controller)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->registered_routes[] = [
                'url' => $route,
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }
    }

    public function post($route, $controller)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->registered_routes[] = [
                'url' => $route,
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }
    }

    public function render()
    {
        $request_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
        $isRouteHome = false;
        // home
        if (!$request_url || $request_url == '/') {

            foreach ($this->registered_routes as $route) {
                if ($route['url'] === '/') {
                    $isRouteHome = true;

                    $class = new $route['class'];
                    $class->{$route['method']}();
                }
            }

            if (!$isRouteHome)
                HttpError::PageNotFound();
        } else {
            $url = $this->parseUrl($request_url);

            if (!$url) {
                HttpError::PageNotFound();
                return;
            }

            $class = new $this->controllers['class'];
            $method = $this->controllers['method'];

            if (!count($this->parameters)) {
                $class->{$method}();
            } else {
                $class->{$method}(...$this->parameters);
            }
        }

        $this->session->clear_flash_datas();
    }

    private function parseUrl($request_url)
    {
        $routing = [
            'static'  => false,
            'dynamic' => false,
        ];

        $url = !$request_url ? '' : $this->splitUrl($request_url);

        foreach ($this->registered_routes as $route) {
            $split_route[] = $this->splitUrl($route['url']);

            $controller = [
                'class'  => $route['class'],
                'method' => $route['method'],
                'path'   => 'app/controllers/' . (new ReflectionClass($route['class']))->getShortName() . '.php',
            ];

            // access static routes
            if ($url[0] === trim($route['url'], '/')) {

                if (file_exists($controller['path'])) {
                    if (method_exists($controller['class'], $controller['method'])) {

                        $routing['static'] = true;
                        $this->controllers = $controller;
                        return $routing['static'];
                    }
                }
            }
        }

        // access dynamic routes
        $temp_route = null;

        for ($i = 0; $i < count($split_route); $i++) {
            if ($url[0] === $split_route[$i][0]) {
                $temp_route = $split_route[$i];
            }
        }

        if ($temp_route !== null) {

            foreach ($temp_route as $key => $val) {

                // matching routes from curly brackets
                if (preg_match('/^\{(.+)\}$/', $val)) {

                    if (!isset($url[$key])) {
                        throw new Exception("Route has parameters, 0 passed");
                        return;
                    }

                    $this->parameters[] = $url[$key];
                    $this->controllers = $controller;
                    $routing['dynamic'] = true;
                }
            }
        }

        return $routing['dynamic'] === true ? true : false;
    }

    private function splitUrl($url)
    {
        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }
}
