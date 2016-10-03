<?php
namespace App;

use Exception; //class bawaan php
use App\RouteCollection;


class Router
{
    private $routes = array();
    private $namedRoutes = array();
    private $basePath = '';
    public function __construct(RouteCollection $collection)
    {
        $this->routes = $collection;

        foreach ($this->routes->all() as $route) {
            $name = $route->getName();
            if (null !== $name) {
                $this->namedRoutes[$name] = $route;
            }
        }
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }

    public function matchCurrentRequest()
    {
        $requestMethod = (
            isset($_POST['_method'])
            && ($_method = strtoupper($_POST['_method']))
            && in_array($_method, array('PUT', 'DELETE'))
        ) ? $_method : $_SERVER['REQUEST_METHOD'];

        $requestUrl = $_SERVER['REQUEST_URI'];
        
        if (($pos = strpos($requestUrl, '?')) !== false) {
            $requestUrl = substr($requestUrl, 0, $pos);
        }

        return $this->match($requestUrl, $requestMethod);
    }

    public function match($requestUrl, $requestMethod = 'GET')
    {
        foreach ($this->routes->all() as $routes) {            
            if (!in_array($requestMethod, (array)$routes->getMethods())) {
                continue;
            }

            $currentDir = dirname($_SERVER['SCRIPT_NAME']);
            if ($currentDir != '/') {
                $requestUrl = str_replace($currentDir, '', $requestUrl);
            }

            $route = rtrim($routes->getRegex(), '/');
            $pattern = "@^{$this->basePath}{$route}/?$@i";
            if (!preg_match($pattern, $requestUrl, $matches)) {
                continue;
            }
            $matchedText = array_shift($matches);

            $params = array();

            if (preg_match_all("/:([\w-%]+)/", $routes->getUrl(), $argument_keys)) {
                $argument_keys = $argument_keys[1];

                
                if(count($argument_keys) != count($matches)) {
                    continue;
                }
                
                foreach ($argument_keys as $key => $name) {
                    if (isset($matches[$key])) {
                        $params[$name] = $matches[$key];
                    }
                }

            }

            $routes->setParameters($params);
            $routes->dispatch();

            return $routes;
        }

        return false;
    }

    /**
     * Balik Routenya
     *
     */
    public function generate($routeName, array $params = array())
    {
        // Cek route eksis
        if (!isset($this->namedRoutes[$routeName])) {
            throw new Exception("$routeName tidak dtemukan.");
        }
        
        $route = $this->namedRoutes[$routeName];
        $url = $route->getUrl();

        if ($params && preg_match_all("/:(\w+)/", $url, $param_keys)) {
            // ambil array yg cocok
            $param_keys = $param_keys[1];
            
            foreach ($param_keys as $key) {
                if (isset($params[$key])) {
                    $url = preg_replace("/:(\w+)/", $params[$key], $url, 1);
                }
            }
        }

        return $url;
    }

    /**
     * parse config dari obje array
     *
     * @param array $config dari static Config::loadFromFile()
     * @return Router
     */
    public static function parseConfig(array $config)
    {
        $collection = new RouteCollection();
        foreach ($config['routes'] as $name => $route) {
            $collection->prosesRoute(new Route($route[0], array(
                'ctr' => str_replace('.', '::', $route[1]),
                'methods' => $route[2],
                'name' => $name
            )));
        }

        $router = new Router($collection);
        if (isset($config['base_path'])) {
            $router->setBasePath($config['base_path']);
        }

        return $router;
    }
}