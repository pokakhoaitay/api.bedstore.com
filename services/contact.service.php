<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 1/30/2016
 * Time: 9:18 PM
 */

use lib\core\Db;



class ContactService{
    protected $db;


    function __construct(){
        $this->db = new Db();
    }

    public function getContact(){

    }

    public function createContact($name, $email, $messages){
        $result=$this->db->query(sprintf('INSERT INTO  contact (name, email, messages) VALUES ("%s","%s","%s")', $name, $email, $messages));
        if(!$result)
        {
            $this->db->rollback();
        }
        $this->db->commit();
        return $result;
    }
}