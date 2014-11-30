<?php
namespace CodeFire;


class Request
{

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $urlParts;

    /**
     * @param string $uri
     * @param string $baseUrl
     */
    public function __construct($uri = '/', $baseUrl = '/')
    {
        $pos = stripos($this->uri, '/v');
        if ($baseUrl != '/')
            $uri = str_ireplace($baseUrl, '', $uri);

        $this->uri = trim($uri, '/');
        $this->urlParts = explode('/', $this->uri);
    }

    /**
     * @return array
     */
    public function getUrlParts()
    {
        return $this->urlParts;
    }

} 