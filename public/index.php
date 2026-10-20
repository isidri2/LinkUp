<?php

session_start();

require_once "../app/controllers/AuthController.php";
require_once "../app/controllers/PostController.php";
require_once "../app/controllers/CommentController.php";
require_once "../app/controllers/LikeController.php";
require_once "../app/controllers/ProfileController.php";
require_once "../app/controllers/SearchController.php";

$action = $_GET["action"] ?? "login";

$authController = new AuthController();
$postController = new PostController();
$commentController = new CommentController();
$likeController = new LikeController();
$profileController = new ProfileController();
$searchController = new SearchController();

switch ($action) {

    case "login":
        $authController->login();
        break;

    case "register":
        $authController->register();
        break;

    case "logout":
        $authController->logout();
        break;

    case "home":
        $postController->index();
        break;

    case "create_post":
        $postController->create();
        break;

    case "edit_post":
        $postController->edit();
        break;

    case "delete_post":
        $postController->delete();
        break;

    case "create_comment":
        $commentController->create();
        break;

    case "ajax_create_comment":
        $commentController->create();
        break;

    case "edit_comment":
        $commentController->edit();
        break;

    case "delete_comment":
        $commentController->delete();
        break;

    case "like":
        $likeController->like();
        break;

    case "unlike":
        $likeController->unlike();
        break;

    case "profile":
        $profileController->profile();
        break;

    case "edit_profile":
        $profileController->edit();
        break;

    case "search":
        $searchController->search();
        break;

    default:
        header("Location: index.php?action=login");
        exit;
}