<?php

namespace Src\Database;

use PDO;

abstract class Connection
{
    private static $conn;

    public static function getConn()
    {
        if (self::$conn == null) {
            self::$conn = new PDO('mysql: host=localhost; dbname=loja_magica;', 'root', '');
        }

        return self::$conn;
    }
}
