
<?php

require_once __DIR__ . "/../../config/database.php";

class PostModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get all posts with each author's current profile information
    public function getAllPosts()
    {
        $sql = "SELECT
                    posts.*,
                    users.username,
                    users.full_name,
                    users.profile_image
                FROM posts
                INNER JOIN users
                    ON posts.user_id = users.id
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new post
    public function createPost($user_id, $content)
    {
        $sql = "INSERT INTO posts (user_id, content)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $user_id,
            $content
        ]);
    }

    // Get one post by ID
    public function getPostById($id)
    {
        $sql = "SELECT *
                FROM posts
                WHERE id = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a post only if it belongs to the logged-in user
    public function updatePost($id, $user_id, $content)
    {
        $sql = "UPDATE posts
                SET content = ?
                WHERE id = ?
                AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $content,
            $id,
            $user_id
        ]);
    }

    // Delete a post only if it belongs to the logged-in user
    public function deletePost($id, $user_id)
    {
        $sql = "DELETE FROM posts
                WHERE id = ?
                AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $id,
            $user_id
        ]);
    }

    // Search posts by content
    public function searchPosts($keyword)
    {
        $sql = "SELECT
                    posts.*,
                    users.username,
                    users.full_name,
                    users.profile_image
                FROM posts
                INNER JOIN users
                    ON posts.user_id = users.id
                WHERE posts.content LIKE ?
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            "%" . $keyword . "%"
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}