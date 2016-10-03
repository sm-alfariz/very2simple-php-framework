<?php

namespace App;

class RouteCollection extends \SplObjectStorage
{

    public function prosesRoute(Route $attachObject)
    {
        parent::attach($attachObject, null);
    }

    public function all()
    {
        $temp = array();
        foreach ($this as $route) {
            $temp[] = $route;
        }

        return $temp;
    }
}