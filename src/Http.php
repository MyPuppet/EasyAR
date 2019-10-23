<?php

/**
 * Http.php
 *
 * @author    MyPuppet <909898509@qq.com>
 * @copyright 2019 MyPuppet <909898509@qq.com>
 *
 * @see      https://github.com/mypuppet
 */

namespace EasyARSdk;

class Http
{
    public static function get($url, $data, $headers = null) {
        return self::sendRequest('GET', $url, $data, $headers);
    }

    public static function patch($url, $data, $headers = null) {
        return self::sendRequest('PATCH', $url, $data, $headers);
    }

    public static function put($url, $data, $headers = null) {
        return self::sendRequest('PUT', $url, $data, $headers);
    }

    public static function delete($url, $data, $headers = null) {
        return self::sendRequest('DELETE', $url, $data, $headers);
    }

    public static function post($url, $data, $headers = null) {
        return self::sendRequest('POST', $url, $data, $headers);
    }

    public static function sendRequest($method, $url, $data = null, $headers = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        switch ($method) {
            case 'GET':
            case 'DELETE':
                if ($data) {
                    $url .= (false === strpos($url, '?')) ? '?' : '&';
                    $url .= http_build_query($data);
                }
                break;
            case 'PUT':
            case 'PATCH':
            case 'POST':
                if ($method == 'POST') {
                    curl_setopt($ch, CURLOPT_POST, 1);
                }
                if ($data) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                }
                break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ('HTTPS' == strtoupper(substr($url, 0, 5))) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $str = curl_exec($ch);
        curl_close($ch);

        return $str;
    }
}