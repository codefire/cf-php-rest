<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 30/11/2014
 * Time: 16:28
 */

namespace CodeFire\Router;

use CodeFire;

/**
 * Class Api
 * @package CodeFire\Router
 */
class Api extends CodeFire\Router
{
    public function __construct(CodeFire\Request $request)
    {
        parent::__construct($request);
    }

    public function getRoute()
    {
        $urlParts = $this->request->getUrlParts();
        $map = [
            0 => 'version',
            1 => 'handler',
            2 => 'command'
        ];
        foreach ($map as $key => $property) {
            if (!empty($urlParts[$key])) {
                $this->route->$property = trim($urlParts[$key]);
                unset($urlParts[$key]);
            }
        }

        if (!empty($urlParts))
            $this->route->args = $urlParts;

        if (!empty($this->route->version) && !empty($this->route->version))
            $this->route->version = (int)\preg_replace('#[^0-9]#i', '', $this->route->version);

        return $this->route;
    }
} 