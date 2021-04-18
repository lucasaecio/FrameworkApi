<?php
class Route extends Kernel
{
    public static function middleware(String $class_name)
    {
        $object = new $class_name();
        $object->handle();
    }

    public static function get(String $router_name, $callback)
    {
        if (!self::validationMethod('GET')) return false;
        return self::getMethod($router_name, $callback);
    }

    public static function put(String $router_name, $callback)
    {
        if (!self::validationMethod('PUT')) return false;
        return self::getMethod($router_name, $callback);
    }

    public static function post(String $router_name, $callback)
    {
        if (!self::validationMethod('POST')) return false;
        return self::getMethod($router_name, $callback);
    }

    public static function patch(String $router_name, $callback)
    {
        if (!self::validationMethod('PATCH')) return false;
        return self::getMethod($router_name, $callback);
    }

    public static function delete(String $router_name, $callback)
    {
        if (!self::validationMethod('DELETE')) return false;
        return self::getMethod($router_name, $callback);
    }
}
