<?php
//jika route ingin di load dari file yml
/*
*
*
contoh file_route.yml
base_path: App\controllers

routes:
  home: [/berita,Berita::index, GET]
*/
namespace App;
use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;
final class RouteYml
{
    private function __construct()
    {
    }
    public static function loadFromFile($yamlFile)
    {
        if (!is_file($yamlFile)) {
            throw new InvalidArgumentException(sprintf('The file %s not exists!', $yamlFile));
        }
        return Yaml::parse(file_get_contents($yamlFile));
    }
}