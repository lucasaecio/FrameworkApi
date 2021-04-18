<?php

use \Firebase\JWT\JWT;

class JwtHelper
{
    public static function checkJwtIntegrity($jwt_token)
    {
        // verificar se o jwt existe
        if (empty($jwt_token)) {
            return true;
        }

        $jwt_array  = explode(" ", $jwt_token);

        // verificar se existe a palavra Bearer
        if ($jwt_array[0] != "Bearer") {
            return true;
        }

        // verificar se existe um token após a palavra
        if (count($jwt_array) < 2) {
            return true;
        }

        // verificar se o token tem 3 pontos
        $array_jwt = explode(".", $jwt_array[1]);
        if (count($array_jwt) < 3) {
            return true;
        }

        return false;
    }

    public static function decode($jwt_token, $key)
    {

        try {
            $data = JWT::decode($jwt_token, $key, array('HS256'));
        } catch (\Exception $e) {
            throw new Exception($e->getMessage);
        }

        return $data;
    }

    public static function encode($payload, $key)
    {
        try {
            $jwt = JWT::encode($payload, $key);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage);
        }

        return $jwt;
    }
}
