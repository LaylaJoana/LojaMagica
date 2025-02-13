<?php

namespace Src\Core;

class Request
{
    private $uri;
    private $method;
    private $params;

    public function __construct()
    {
        $this->uri = $this->getUri();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST;
    }

    public function getUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return trim($uri, '/');
    }

    public function getUriSegments()
    {
        return explode('/', $this->uri);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    public function getAllParams()
    {
        return $this->params;
    }

    public function getHeader($header)
    {
        $header = str_replace('-', '_', strtoupper($header));
        return isset($_SERVER['HTTP_' . $header]) ? $_SERVER['HTTP_' . $header] : null;
    }

    public function setParams($params): void {
        $this->params = $params;
    }

    public function getParams(): array {
        return $this->params;
    }
}