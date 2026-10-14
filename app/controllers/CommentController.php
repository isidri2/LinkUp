<?php

require_once __DIR__ . "/../models/CommentModel.php";

class CommentController
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function create()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $post_id = $_POST["post_id"] ?? 0;
        $content = trim($_POST["content"] ?? "");

        if (!empty($content)) {
            $this->commentModel->createComment(
                $post_id,
                $_SESSION["user_id"],
                $content
            );
        }

        header("Location: index.php?action=home");
        exit;
    }

    public function edit()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET["id"] ?? 0;

        $comment = $this->commentModel->getCommentById($id);

        if (
            !$comment ||
            $comment["user_id"] != $_SESSION["user_id"]
        ) {
            die("You are not allowed to edit this comment.");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $content = trim($_POST["content"]);

            if (!empty($content)) {

                $this->commentModel->updateComment(
                    $id,
                    $_SESSION["user_id"],
                    $content
                );

                header("Location: index.php?action=home");
                exit;
            }

            $error = "Comment cannot be empty.";
        }

        require "../app/views/comments/edit.php";
    }

    public function delete()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET["id"] ?? 0;

        $this->commentModel->deleteComment(
            $id,
            $_SESSION["user_id"]
        );

        header("Location: index.php?action=home");
        exit;
    }
}