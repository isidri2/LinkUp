<?php

require_once __DIR__ . "/../models/UserModel.php";
require_once __DIR__ . "/../models/PostModel.php";

class SearchController
{
    private $userModel;
    private $postModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
    }

    public function search()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $keyword = trim($_GET["keyword"] ?? "");

        $users = [];
        $posts = [];

        if (!empty($keyword)) {

            $users = $this->userModel->searchUsers($keyword);

            $posts = $this->postModel->searchPosts($keyword);
        }

        require "../app/views/search.php";
    }
}