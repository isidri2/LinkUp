<?php

require_once __DIR__ . "/../models/PostModel.php";

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    // Show newsfeed
    public function index()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $posts = $this->postModel->getAllPosts();

        require "../app/views/posts/newsfeed.php";
    }

    // Create post
    public function create()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $content = trim($_POST["content"]);

            if (empty($content)) {
                $error = "Post cannot be empty.";

                require "../app/views/posts/create.php";
                return;
            }

            $this->postModel->createPost(
                $_SESSION["user_id"],
                $content
            );

            header("Location: index.php?action=home");
            exit;
        }

        require "../app/views/posts/create.php";
    }

    // Edit post
    public function edit()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET["id"] ?? 0;

        $post = $this->postModel->getPostById($id);

        if (!$post || $post["user_id"] != $_SESSION["user_id"]) {
            die("You are not allowed to edit this post.");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $content = trim($_POST["content"]);

            if (empty($content)) {
                $error = "Post cannot be empty.";

                require "../app/views/posts/edit.php";
                return;
            }

            $this->postModel->updatePost(
                $id,
                $_SESSION["user_id"],
                $content
            );

            header("Location: index.php?action=home");
            exit;
        }

        require "../app/views/posts/edit.php";
    }

    // Delete post
    public function delete()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET["id"] ?? 0;

        $this->postModel->deletePost(
            $id,
            $_SESSION["user_id"]
        );

        header("Location: index.php?action=home");
        exit;
    }
}