
<?php

class Database
{
    private $host = "localhost";
    private $database = "social_app";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";

            $conn = new PDO(
                $dsn,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );

            return $conn;

        } catch (PDOException $e) {
            // Log technical details without exposing them to visitors.
            error_log("LinkUp database connection error: " . $e->getMessage());

            throw new RuntimeException(
                "Unable to connect to the database. Please try again later.",
                0,
                $e
            );
        }
    }
}