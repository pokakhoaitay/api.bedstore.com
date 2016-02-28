<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/12/2016
 * Time: 1:36 PM
 */

require_once __DIR__ . '/../../services/SiteService.php';

$app->get('/admin/site/get-site-data/{catName}', function ($request, $response, $args) {
    $contact = new SiteService();
    $catName=$args['catName'];
    $result= $contact->getSiteInfo($catName);
    $error = null;
    if(!$result)
        $error='Unable fetch data';//TODO: Detail error for client
    return AppCore::JsonResponse($response, $result,200, $error );
});
