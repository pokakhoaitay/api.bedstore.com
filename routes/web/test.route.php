<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/9/2016
 * Time: 1:53 PM
 */

$app->get('/web/test', function ($req, $res, $args) {
    $auth=$req->getHeaderLine('auth');
    $res=$res->withJson(['data' => 'I am from API']);
    return $res;
});

$app->post('/web/test-post', function ($req, $res, $args) {
    $auth=$req->getHeaderLine('auth');
    $res=$res->withJson(['data' => 'I am from API Post']);
    //throw new Exception('Virus');
    return $res;
});