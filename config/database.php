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

            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch (PDOException $e) {

            die("Database Error: " . $e->getMessage());

        }
    }
}