<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/12/2016
 * Time: 1:36 PM
 */

require_once __DIR__ . '/../../services/SiteService.php';
use lib\config\ApiConfig;

$app->get('/admin/site/get-site-data/{catName}', function ($request, $response, $args) {
    $contact = new SiteService();
    $catName=$args['catName'];
    $result= $contact->getSiteInfo($catName);
    return AppCore::JsonResponse($response, $result, $result ? true : false);
});
