<?php

require_once __DIR__ . "/../../config/database.php";

class UserModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($username, $password, $full_name)
    {
        $sql = "INSERT INTO users
                (username, password, full_name)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        return $stmt->execute([
            $username,
            $password,
            $full_name
        ]);
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users
                WHERE username = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile(
        $id,
        $full_name,
        $bio,
        $profile_image
    ) {
        $sql = "UPDATE users
                SET full_name = ?,
                    bio = ?,
                    profile_image = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $full_name,
            $bio,
            $profile_image,
            $id
        ]);
    }
}