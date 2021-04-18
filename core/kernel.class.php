<?php


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class Kernel
{
    # verifica o nome darota
    private static function validationUrlName(String $router_name)
    {
        $request = Request::createFromGlobals();

        # separando parametros da url
        $var_router_name = (explode('/', $router_name));
        $var_path = (explode('/', $request->getPathInfo()));

        # filtrando array
        $var_router_name  = array_filter($var_router_name);
        $var_path = array_filter($var_path);

        # Inclui os parametros na requisição
        foreach ($var_router_name as $key => $value) {
            $parameter = preg_filter("/[{,}]/", "", $value);

            if (empty($var_path[$key])) {
                return false;
            }

            if (!empty($parameter)) {
                unset($var_router_name[$key]);
                unset($var_path[$key]);
            }
        }

        if (array_diff_assoc($var_path, $var_router_name)) {
            return false;
        }

        return true;
    }

    # validando regras do methodo
    static function validationMethod($method_name)
    {

        $request = Request::createFromGlobals();

        #verifica o nome do verbo http
        if ($request->server->all()['REQUEST_METHOD'] != $method_name) {
            return false;
        }
        return true;
    }


    #chama o controle
    static function getMethod($router_name, $callback)
    {

        // validando a url
        if (!self::validationUrlName($router_name)) return false;

        // definindo class e o metodo a ser utilizado
        $request = Request::createFromGlobals();

        $METHOD = $request->server->get('REQUEST_METHOD');


        //-------------------------------------------------------
        // Retorna parametros passadas na url

        self::implementParametersUrl($request, $router_name);

        //-------------------------------------------------------


        if (count($callback) < 1) return false;

        $class = $callback[0];
        $method = $callback[1];
        $object = new $class();
        $headers = [];

        $headers["Access-Control-Allow-Origin"] = "*";

        if ($METHOD == 'GET' || $METHOD == 'OPTIONS') {
            $headers["Access-Control-Expose-Headers"] = "content-type, content-range, accept-range, content-Length, X-JSON";
        }

        if ($METHOD == "OPTIONS") {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                $headers["Access-Control-Allow-Methods"] = "PUT, GET, POST, DELETE, OPTIONS";
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                $headers["Access-Control-Allow-Headers"] = "origin, content-type, accept, session-token, authorization";
            }
        }


        $res =  $object->$method($request ?? null);
        $response = new JsonResponse($res, $res['code'] ?? 200, $headers);
        return $response->send();
    }

    #verifica paramentro na URI
    protected static function validationUriParams($uri, $callback)
    {
        $request = new Request();

        $var_path = (explode('/', $request->getPathInfo()));

        if (!isset($var_path[1])) return false;
    }

    private static function implementParametersUrl($request, $router_name)
    {
        # separando parametros da url
        $var_router_name = (explode('/', $router_name));
        $var_path = (explode('/', $request->getPathInfo()));

        # filtrando array
        $var_router_name  = array_filter($var_router_name);
        $var_path = array_filter($var_path);

        # Inclui os parametros na requisição
        foreach ($var_router_name as $key => $value) {
            $parameter = preg_filter("/[{,}]/", "", $value);

            if (!empty($parameter)) {
                $request->parameters->$parameter = $var_path[$key];
            }
        }
    }
}
