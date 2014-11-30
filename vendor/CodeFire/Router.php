<?php
namespace CodeFire;


class Router
{
    /**
     * @var Request
     */
    protected $request;

    protected $route;

    public function __construct( Request $request )
    {
        $this->request = $request;
        $this->route = new \stdClass();
    }

    public function getRequest()
    {
        return $this->request;
    }
} 