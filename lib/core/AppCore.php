<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/3/2016
 * Time: 5:29 AM
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class AppCore
{
//    protected $app;
//    protected $container;
//    protected $request;
//    protected $response;
//
//    function __construct($container)
//    {
//        $this->response=$container['response'];
//        $this->request=$container['request'];
//    }
//    public function __invoke(Request $request,  Response $response, $args)
//    {
//        $this->request = $request;
//        $this->response = $response;
//        return $response;
//    }
//    public function AllowRoutePass()
//    {
//        $reqMethod =$this->request->getMethod().'/'.$this->request->getUri()->getPath();
//        if (in_array($reqMethod, AppConfig::IGNORE_ROUTES))
//            return true;
//        return false;
//    }
//
//    public static function GetNativeUrlPath($url)
//    {
//        if (empty($url))
//            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//        return parse_url($url, PHP_URL_PATH);
//    }

    public static function CheckIgnoreRoute($urlToCheck)
    {
        if (in_array($urlToCheck, AppConfig::IGNORE_ROUTES))
            return true;
        return false;
    }

    public static function JsonResponse($res, $data, $status, $error)
    {
        return $res = $res->withJson([
            'data' => $data,
            'status' => $status,
            'error'=>$error
        ]);
    }

//    public static function JsonResponseSuccess($res, $data)
//    {
//        return self::JsonResponse($res, $data, true);
//    }
//
//    public static function JsonResponseFail($res, $data)
//    {
//        return self::JsonResponse($res, $data, false);
//    }

}