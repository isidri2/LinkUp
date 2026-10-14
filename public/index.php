<?php

session_start();

require_once "../app/controllers/AuthController.php";
require_once "../app/controllers/PostController.php";


$action = $_GET["action"] ?? "login";


$authController = new AuthController();

$postController = new PostController();


switch ($action) {

    // LOGIN
    case "login":

        $authController->login();

        break;


    // REGISTER
    case "register":

        $authController->register();

        break;


    // LOGOUT
    case "logout":

        $authController->logout();

        break;


    // HOME / NEWSFEED
    case "home":

        $postController->index();

        break;


    // CREATE POST
    case "create_post":

        $postController->create();

        break;


    // EDIT POST
    case "edit_post":

        $postController->edit();

        break;


    // DELETE POST
    case "delete_post":

        $postController->delete();

        break;


    default:

        header("Location: index.php?action=login");

        break;
}