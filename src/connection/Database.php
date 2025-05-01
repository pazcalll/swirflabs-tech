<?php

namespace Src\Connection;

use PDO;
use PDOException;

class Database
{
    private static $instance = null; // Holds the single instance of the connection
    private $connection;

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=swirflabs-tech;port=3306',
                'root',
                null
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Get the single instance of the connection
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get the PDO connection
    public function getConnection()
    {
        return $this->connection;
    }
}