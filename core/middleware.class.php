<?php

require_once("autoload.php");

class Middleware
{
    protected $middleware = [];

    public function __construct(array $middleware)
    {
        $this->middleware = $middleware;
        $this->compile();
    }

    public function compile()
    {
        foreach ($this->middleware as $key => $value) {
            if (class_exists($value)) {
                $object = new $value();
                if (method_exists($object, 'handle')) {
                    $object->handle();
                }
            }
        }
    }
}
