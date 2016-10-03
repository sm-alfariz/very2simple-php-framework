<?php
namespace Helper;
use Symfony\Component\Yaml\Yaml; 
use Illuminate\Database\Capsule\Manager as Capsule;
class MyHelper {
    public static function konekDB($yml_config)
    {
		try {
		    //$db['config'] = Yaml::parse(file_get_contents(__DIR__.'/config/database.yml'));
		    $db['config'] = Yaml::parse(file_get_contents($yml_config));
		} catch (ParseException $e) {
		    printf("Unable to parse the YAML string: %s", $e->getMessage());
		}
		$capsule = new Capsule;
		$capsule->addConnection(
		    $db['config']['database']['connections'][
		        $db['config']['database']['connection']
		    ]
		);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
		return $capsule;    	
    }   
    public static function getBaseUrl($yml_config)
    {
		try {		
			$app['url'] = Yaml::parse(file_get_contents($yml_config));
		} catch (ParseException $e) {
			printf("Unable to parse the YAML string: %s", $e->getMessage());
		}
		return $app['url']['settings']['base_url'] ;
    }
	//Teknik lama  
	public static function getUriSegment($n) {
	    $segs = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	    return count($segs) > 0 && count($segs) >= ($n-1) ? $segs[$n] : '';
	}    
}