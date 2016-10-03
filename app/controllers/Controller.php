<?php
namespace App\controllers ;

Class Controller {
	public function __construct()
	{
	
	}
	public function render_template($template,$data = [])
	{		
		$loader = new \Twig_Loader_Filesystem(__DIR__.'/../../templates');
		$function = new \Twig_SimpleFunction('limit_str', function ($text, $limit) { 
		      if (str_word_count($text, 0) > $limit) {
		          $words = str_word_count($text, 2);
		          $pos = array_keys($words);
		          $text = substr($text, 0, $pos[$limit]) . '...';
		      }
		      return $text;    
		});
		$twig = new \Twig_Environment($loader, array(
		    'cache' => 'cache',
		    'debug' => true,
		    'auto_reload' => true,
		));
		$twig->addGlobal('base_url', 'http://localhost:8000/');
		$twig->addFunction($function);			
		return $twig->render($template, $data);		
	}
}