<?php
/**
 * Created by PhpStorm.
 * Date: 12/12/15
 * Time: 3:47 PM
 */
class Database
{
    private static $dbName = 'shurov00_db' ;
    private static $dbHost = 'shurov00.mysql.ukraine.com.ua' ;
    private static $dbUsername = 'shurov00_db';
    private static $dbUserPassword = 'ceLpGTeE';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if ( null == self::$cont )
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>