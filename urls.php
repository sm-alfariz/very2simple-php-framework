<?php
require_once __DIR__.'/bootstrap.php'; //dipisahkan utk urusan load composer sama load config database
use App\RouteCollection;
use App\Router;
use App\Route;
$collection = new RouteCollection();
$collection->prosesRoute(new Route('/', array('ctrl' => 'App\controllers\Berita::index','methods' => 'GET','name'=>'get.home')));
$collection->prosesRoute(new Route('/berita', array('ctrl' => 'App\controllers\Berita::index','methods' => 'GET','name'=>'get.berita')));
$collection->prosesRoute(new Route('/berita/:slug', array('ctrl' => 'App\controllers\Berita::BacaBerita','methods' => 'GET','name'=>'get.beritaBaca')));

$router = new Router($collection);
$router->setBasePath('');
$route = $router->matchCurrentRequest();

if(!$route){
	header("HTTP/1.0 404 Not Found");	
	exit('Halaman Tidak ditemukan') ;
}
//var_dump($route);
/**** jika ingin diLoad route nya dengan yml
pastikan final class RouteYml di load serta class route lainnya 
use App\RouteYml;
use App\RouteCollection;
use App\Router;
use App\Route;
$config = Config::loadFromFile(__DIR__.'/router.yaml');
$router = Router::parseConfig($config);
$router->matchCurrentRequest();