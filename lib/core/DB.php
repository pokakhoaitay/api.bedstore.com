<?php
/**
 * Created by PhpStorm.
 * User: Poka
 * Date: 1/30/2016
 * Time: 8:26 PM
 */

namespace lib\core;

use lib\config\DbConfig;
use mysqli;

require_once __DIR__ . '/../config/DBConfig.php';

/**
 * Referrence to this: https://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17
 * @package lib\core
 */
class Db
{
    protected static $connection;

    public function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli(
                DbConfig::HOST
                , DbConfig::USER_NAME
                , DbConfig::USER_PASSWORD
                , DbConfig::DB_NAME
            );
        }
        //If connection was not success, handle the error
        if (!self::$connection) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            $er = mysqli_error(self::$connection);
            error_log($er);
            //return false;
            throw new \Exception('Connection error');
        } else {
            if (self::$connection->connect_errno > 0) {
                $er = mysqli_connect_error();
                error_log($er);
                //return false;
                throw new \Exception('Connection error');
            } else {
                self::$connection->autocommit(false);
                self::$connection->set_charset("utf8");
            }
        }

        return self::$connection;
    }

    /**
     * Execute sql
     * @param $query : The sql query string
     * @return bool False on failure / array Database object on success
     * @throws \Exception
     */
    public function query($query)
    {
        $this->connect();
        $result = self::$connection->query($query);
        if ($result === false) {
            $er = mysqli_error(self::$connection);
            error_log($er);
            return false;
        }
        return $result;
    }


    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query)
    {
        $rows = array();
        $result = $this->query($query);
        if ($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value)
    {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }

    public function rollback()
    {
        self::$connection->rollback();
    }

    public function commit()
    {
        self::$connection->commit();
    }

    /**
     * Fetch the last error from the database
     *
     * @return string Database error message
     */

    public function getError()
    {
        return mysqli_error(self::$connection);
    }

    public function getErrors()
    {
        return mysqli_error_list(self::$connection);
    }
}