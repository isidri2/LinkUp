<?php

require_once __DIR__ . "/../models/LikeModel.php";

class LikeController
{
    private $likeModel;

    public function __construct()
    {
        $this->likeModel = new LikeModel();
    }

    public function like()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $post_id = $_GET["id"] ?? 0;
        $user_id = $_SESSION["user_id"];

        if (!$this->likeModel->hasLiked($post_id, $user_id)) {
            $this->likeModel->likePost(
                $post_id,
                $user_id
            );
        }

        header("Location: index.php?action=home");
        exit;
    }

    public function unlike()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $post_id = $_GET["id"] ?? 0;
        $user_id = $_SESSION["user_id"];

        $this->likeModel->unlikePost(
            $post_id,
            $user_id
        );

        header("Location: index.php?action=home");
        exit;
    }
}