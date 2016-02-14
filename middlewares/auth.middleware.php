<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/9/2016
 * Time: 4:06 PM
 */
use \lib\config\ApiConfig;

$app->add(function ($request, $response, $next) {
    $method = $request->getMethod();
    $contentRaw = $request->getParams();//For POST anf PUT method
    $content = http_build_query($contentRaw);
    $contentType = $request->getHeaderLine('Content-Type');
    $date = $request->getHeaderLine('X-Date');
    $path = $request->getUri()->getPath();
    $port = $request->getUri()->getPort();
    $uri = Utils::getAddress();
    $signature = $method . '\n'
        . md5($content) . '\n'
        . $contentType . '\n'
        . $date . '\n'
        . $uri;


    $authString = $request->getHeaderLine('auth');
    if (empty($authString))
        $response = $response->withStatus(401);
    else {
        $authHeaderArr = explode(', ', $authString);
        if (is_null(ApiConfig::TOKEN_SOURCE[$authHeaderArr[0]])) {
            $response = $response->withStatus(401);
        } else {
            $secretKey = ApiConfig::TOKEN_SOURCE[$authHeaderArr[0]];
            $sigCalc = Utils::calculateHMAC($signature, $secretKey);
            $sigHeader = $authHeaderArr[1];
            if ($sigCalc == $sigHeader) {
                $response = $next($request, $response);
            } else {
                $response = $response->withStatus(401);
            }
        }

    }

    //$secretKey = \lib\config\ApiConfig::TOKEN_SOURCE[]

    // $response = $next($request, $response);


    return $response;
});