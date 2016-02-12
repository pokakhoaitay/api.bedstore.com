<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 1/28/2016
 * Time: 5:37 PM
 */
namespace lib\config;
class AppConfig
{
    const SLIM_CONFIGS = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];

    const IGNORE_ROUTES = array(
        'init-session'
    );
}

