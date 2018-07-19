<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:16 PM
 */

namespace core\http;




class Request
{
    protected $queryParams = [];
    protected $bodyParams = [];

    public function get($name)
    {
        return array_key_exists($name, $this->queryParams) ? $this->queryParams[$name] : null;
    }

    public function post($name)
    {
        return array_key_exists($name, $this->bodyParams) ? $this->bodyParams[$name] : null;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function getBodyParams()
    {
        return $this->bodyParams;
    }

    public function withParsedBody($bodyParams = []) {
        $class = clone $this;
        $class->bodyParams = array_merge($class->bodyParams, $bodyParams);
        return $class;
    }


    public function withQueryParams($queryParams = []) {
        $class = clone $this;
        $class->queryParams = array_merge($this->queryParams, $queryParams);
        return $class;
    }
}
