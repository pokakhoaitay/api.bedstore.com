<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/12/2016
 * Time: 1:36 PM
 */

require_once __DIR__ . '/../../services/contact.service.php';
use lib\config\ApiConfig;

$app->post('/web/contact/create-contact', function ($request, $response, $submitData) {
    $contact = new ContactService();
    $data = $request->getParams();
    $contact->createContact($data['name'], $data['email'], $data['messages']);
    return AppCore::JsonResponse($response, null, $contact ? true : false);
});
