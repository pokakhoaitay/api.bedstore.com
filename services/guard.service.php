<?php

/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/2/2016
 * Time: 9:39 PM
 */

use lib\config\ApiConfig;

class GuardSevice
{

    function __construct()
    {

    }

    public function InitSession()
    {
        $timestamp=time();
        $hashedPublicKey = HASH_HMAC(
            'sha512'
            , ApiConfig::API_PUBLIC_KEY.$timestamp
            , ApiConfig::API_SECRET_KEY
        );
        setcookie(ApiConfig::TOKEN_NAME_WEB, $hashedPublicKey, time() + (86400 * 7), "/"); // 86400 = 1 day
        $_SESSION[ApiConfig::TOKEN_NAME_WEB] = $hashedPublicKey;
    }


}