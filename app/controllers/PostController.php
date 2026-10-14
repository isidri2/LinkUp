<?php

require_once __DIR__ . "/../models/PostModel.php";
require_once __DIR__ . "/../models/CommentModel.php";
require_once __DIR__ . "/../models/LikeModel.php";

class PostController
{
    private $postModel;
    private $commentModel;
    private $likeModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();
    }


    public function index()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $posts = $this->postModel->getAllPosts();

        $postComments = [];
        $postLikes = [];
        $postLiked = [];

        foreach ($posts as $post) {

            $postComments[$post["id"]] =
                $this->commentModel->getCommentsByPost(
                    $post["id"]
                );

            $postLikes[$post["id"]] =
                $this->likeModel->countLikes(
                    $post["id"]
                );

            $postLiked[$post["id"]] =
                $this->likeModel->hasLiked(
                    $post["id"],
                    $_SESSION["user_id"]
                );
        }

        require "../app/views/posts/newsfeed.php";
    }


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


    public function edit()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET["id"] ?? 0;

        $post = $this->postModel->getPostById($id);

        if (!$post || $post["user_id"] != $_SESSION["user_id"]) {
            header("Location: index.php?action=home");
            exit;
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