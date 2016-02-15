<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 1/28/2016
 * Time: 5:37 PM
 */
class AppConfig
{
    const SLIM_CONFIGS = [
        'settings' => [
            'displayErrorDetails' => false,
        ],
    ];

    const IGNORE_ROUTES = array(
        'init-session'
    );

    const IS_DEBUG = true;
    const SERVER_ERR_MSG = 'Internal Server Error';
}

