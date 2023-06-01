<?php

class DatabaseConnection extends mysqli
{
    private static $instance;

    private function __construct()
    {
        parent::__construct("localhost", "root", "", "lakbaytek");
    }

    public static function getInstance(): mysqli
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }
}
