
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

    // Register a new user with a hashed password.
    public function register($username, $password, $full_name)
    {
        $sql = "INSERT INTO users
                (username, password, full_name)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        if ($hashedPassword === false) {
            throw new RuntimeException("Password hashing failed.");
        }

        return $stmt->execute([
            $username,
            $hashedPassword,
            $full_name
        ]);
    }

    // Find a user by username.
    public function findByUsername($username)
    {
        $sql = "SELECT *
                FROM users
                WHERE username = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Find a user by ID.
    public function findById($id)
    {
        $sql = "SELECT *
                FROM users
                WHERE id = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a user's profile.
    public function updateProfile(
    $id,
    $full_name,
    $bio,
    $profile_image,
    $cover_photo
) {
    $sql = "UPDATE users
            SET full_name = ?,
                bio = ?,
                profile_image = ?,
                cover_photo = ?
            WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        $full_name,
        $bio,
        $profile_image,
        $cover_photo,
        $id
    ]);
}

    // Search users by username or full name.
    public function searchUsers($keyword)
    {
        $sql = "SELECT id, username, full_name, bio, profile_image
                FROM users
                WHERE username LIKE ?
                   OR full_name LIKE ?
                ORDER BY username ASC";

        $stmt = $this->conn->prepare($sql);

        $searchTerm = "%" . $keyword . "%";

        $stmt->execute([
            $searchTerm,
            $searchTerm
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Count registered users for summary reports.
    public function countUsers()
    {
        $sql = "SELECT COUNT(*) FROM users";

        $stmt = $this->conn->query($sql);

        return (int) $stmt->fetchColumn();
    }
}