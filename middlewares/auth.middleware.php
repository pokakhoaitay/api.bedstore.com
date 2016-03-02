<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/9/2016
 * Time: 4:06 PM
 */

$app->add(function ($request, $response, $next) {
    $method = $request->getMethod();
    $contentRaw = $request->getParams();//For POST anf PUT method
    $content = http_build_query($contentRaw);
    $contentType = $request->getHeaderLine('Content-Type');
    $date = $request->getHeaderLine('X-Date');
    $uri = Utils::getAddress();
    $signature = $method . '\n'
        . md5($content) . '\n'
        . $contentType . '\n'
        . $date . '\n'
        . $uri;

    $authString = $request->getHeaderLine('X-Auth');
    $authHeaderArr = explode(' ', $authString);

    if (
        !empty($authString)
        && !is_null($authHeaderArr[0])
        && $authHeaderArr[0] == 'BED_WEB' || $authHeaderArr[0] == 'BED_ADM'
        && !is_null($authHeaderArr[1])
        && !is_null(explode(':', $authHeaderArr[1]))//&&false
    ) {
        $accessKey = explode(':', $authHeaderArr[1])[0];
        $sigHeader = explode(':', $authHeaderArr[1])[1];
        $secretKey = ApiConfig::TOKEN_SOURCE[$accessKey];
        $sigCalc = Utils::calculateHMAC($signature, $secretKey);

        if ($sigCalc == $sigHeader) {
            $response = $next($request, $response);
        }
    }else{
        $response = $response->withStatus(401);
    }
    return $response;
});