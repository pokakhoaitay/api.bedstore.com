<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/2/2016
 * Time: 9:29 PM
 */
use lib\config\ApiConfig;
use lib\core;

class AppGuardMiddleware
{
    //protected $appCore;

    function __construct()
    {
        //$this->appCore = $appCore;
    }

    /**
     * @param $request
     * @param $response
     * @param $next
     * Application middleware. Application middleware is invoked for every incoming HTTP request.
     */
    public function __invoke($request, $response, $next)
    {

        if (AppCore::CheckIgnoreRoute($request->getUri()->getPath())) {
            $response = $next($request, $response);
        } else {
            if (!isset($_COOKIE[ApiConfig::TOKEN_NAME_WEB])) {
                $response = $this->DenyAccess($request, $response);
            } else {
                $headerTooken = $request->getHeader(ApiConfig::TOKEN_HEADER_NAME_WEB);
                if (isset($headerTooken)
                    && !empty($headerTooken[0])
                    && isset($_SESSION[ApiConfig::TOKEN_NAME_WEB])
                ) {
                    $sessionToken = $_SESSION[ApiConfig::TOKEN_NAME_WEB];
                    if ($headerTooken[0] == $sessionToken) {
                        $response = $next($request, $response);
                    } else {
                        $response = $this->DenyAccess($request, $response);
                    }
                } else {
                    $response = $this->DenyAccess($request, $response);
                }
            }

        }


        //The code for the function like 'AfterExecute' in .NET MVC here
        //..

        return $response;
    }

    function DenyAccess($request, $response)
    {
        $response = $response->withStatus(403);
        return $response;
    }
}


