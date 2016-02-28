<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/12/2016
 * Time: 1:36 PM
 */

require_once __DIR__ . '/../../services/contact.service.php';

$app->post('/web/contact/create-contact', function ($request, $response, $agrs) {
    $service = new ContactService();
    $params = $request->getParams();
    $service->createContact($params['name'], $params['email'], $params['messages']);
    return AppCore::JsonResponse($response, null,200,null);
});
