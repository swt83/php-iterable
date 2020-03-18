<?php

namespace Travis;

class IterableAPI
{
    /**
     * Make an API request.
     *
     * @param   string  $key
     * @param   string  $type
     * @param   string  $method
     * @param   array   $arguments
     * @param   int     $timeout
     * @return  array
     */
    public static function run($key, $type, $method, $arguments = [], $timeout = 30)
    {
        // prepare payload
        $payload = http_build_query(array_merge(['api_key' => $key], $arguments));

        // set endpoint
        $url = 'https://api.iterable.com/api/'.$method.'?'.$payload;

        // make curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($type));
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if failure code...
        if ($httpcode !== 200) return false;

        // catch errors...
        if (curl_errno($ch))
        {
            #$errors = curl_error($ch);

            $result = false;
        }

        // else if NO errors...
        else
        {
            // decode
            $result = json_decode($response);
        }

        // close
        curl_close($ch);

        // return
        return $result;
    }
}