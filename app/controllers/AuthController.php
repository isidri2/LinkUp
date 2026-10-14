<?php

require_once __DIR__ . "/../models/UserModel.php";

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $full_name = trim($_POST["full_name"]);
            $username = trim($_POST["username"]);
            $password = $_POST["password"];

            if (
                empty($full_name) ||
                empty($username) ||
                empty($password)
            ) {

                $error = "Please fill in all fields.";

                require "../app/views/auth/register.php";
                return;
            }

            if (
                $this->userModel
                ->findByUsername($username)
            ) {

                $error = "Username already exists.";

                require "../app/views/auth/register.php";
                return;
            }

            $this->userModel->register(
                $username,
                $password,
                $full_name
            );

            header("Location: index.php?action=login");
            exit;
        }

        require "../app/views/auth/register.php";
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST["username"]);
            $password = $_POST["password"];

            $user = $this->userModel
                ->findByUsername($username);

            if (
                $user &&
                password_verify(
                    $password,
                    $user["password"]
                )
            ) {

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];

                header("Location: index.php?action=home");
                exit;

            } else {

                $error = "Invalid username or password.";

                require "../app/views/auth/login.php";
                return;
            }
        }

        require "../app/views/auth/login.php";
    }

    public function logout()
    {
        session_destroy();

        header("Location: index.php?action=login");
        exit;
    }
}