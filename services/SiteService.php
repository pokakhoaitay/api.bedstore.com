<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 1/30/2016
 * Time: 9:18 PM
 */

use lib\core\Db;


class SiteService extends ServiceBase
{
    public function getSiteInfo($catName)
    {
        $catNamex = $this->db->quote($catName);
        $result = $this->db->select("SELECT * FROM site_data WHERE categoryName=".$catNamex." AND isActive=1");
        return $result;
    }


}