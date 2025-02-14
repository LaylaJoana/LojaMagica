<?php

namespace Src\Database;

use PDO;

abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if (self::$conn == null) {
            self::$conn = new PDO('mysql:host=loja_magica_db;port=3306;dbname=loja_magica;charset=utf8', 'root', 'root');
        }

        return self::$conn;
    }

    public static function beginTransaction()
    {
        self::getConn()->beginTransaction();
    }

    public static function commit()
    {
        self::getConn()->commit();
    }

    public static function rollBack()
    {
        self::getConn()->rollBack();
    }

    public static function executeSql($sql)
    {
        $con = Connection::getConn();
        $sql = $con->prepare($sql);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}
