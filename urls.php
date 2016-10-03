<?php
require_once __DIR__.'/bootstrap.php'; //dipisahkan utk urusan load composer sama load config database
use App\RouteCollection;
use App\Router;
use App\Route;

$app = new RouteCollection();
$app->prosesRoute(new Route('/', array('ctrl' => 'App\controllers\Berita::index','methods' => 'GET','name'=>'get.home')));
$app->prosesRoute(new Route('/berita', array('ctrl' => 'App\controllers\Berita::index','methods' => 'GET','name'=>'get.berita')));
$app->prosesRoute(new Route('/berita/:slug', array('ctrl' => 'App\controllers\Berita::BacaBerita','methods' => 'GET','name'=>'get.beritaBaca')));

$router = new Router($app);
$router->setBasePath('');
$route = $router->matchCurrentRequest();

if(!$route){
	header("HTTP/1.0 404 Not Found");	
	//var_dump($route);
	exit('Halaman Tidak ditemukan') ;
}