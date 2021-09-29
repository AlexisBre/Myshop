<?php
class database
{
    private static $dbHost = "127.0.0.1";
    private static $dbName = "my_shop";
    private static $dbUser = "root";
    private static $dbUserPassword = "root";
    private static $dbPort = "8889";

    private static $connection = null;

    public static function connect()
    {
        try
        {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName. ";port=".self::$dbPort ,self::$dbUser,self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
            die($e->getmessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>