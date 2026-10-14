<?php

require_once __DIR__ . "/../../config/database.php";

class CommentModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getCommentsByPost($post_id)
    {
        $sql = "SELECT comments.*, users.username, users.full_name
                FROM comments
                INNER JOIN users
                ON comments.user_id = users.id
                WHERE comments.post_id = ?
                ORDER BY comments.created_at ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$post_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment($post_id, $user_id, $content)
    {
        $sql = "INSERT INTO comments
                (post_id, user_id, content)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $post_id,
            $user_id,
            $content
        ]);
    }

    public function getCommentById($id)
    {
        $sql = "SELECT * FROM comments
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateComment($id, $user_id, $content)
    {
        $sql = "UPDATE comments
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

    public function deleteComment($id, $user_id)
    {
        $sql = "DELETE FROM comments
                WHERE id = ?
                AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $id,
            $user_id
        ]);
    }
}