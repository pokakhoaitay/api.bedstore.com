<?php

/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 2/24/2016
 * Time: 11:14 PM
 */
class ServiceBase
{
    protected $db;
    public function __construct()
    {
        $this->db=new \lib\core\Db();
    }
}