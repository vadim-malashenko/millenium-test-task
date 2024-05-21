<?php

namespace Millenium\TestTask\Data;

use Millenium\TestTask\Data\Storage\MySqlStorage;

class StorageFactory
{
    static function mysql(string $database, string $user, string $password, string $host = "localhost")
    {
        $dsn = "mysql:dbname={$database};host={$host}";
        $storage = new MySqlStorage($dsn, $user, $password);

        return $storage;
    }
}