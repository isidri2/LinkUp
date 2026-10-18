
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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $full_name = trim($_POST["full_name"] ?? "");
            $username = trim($_POST["username"] ?? "");
            $password = $_POST["password"] ?? "";

            // Validate required fields.
            if (
                $full_name === "" ||
                $username === "" ||
                $password === ""
            ) {
                $error = "Please fill in all fields.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }

            // Validate field lengths.
            if (strlen($full_name) > 100) {
                $error = "Full name must not exceed 100 characters.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }

            if (strlen($username) > 50) {
                $error = "Username must not exceed 50 characters.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }

            if (strlen($password) < 8) {
                $error = "Password must be at least 8 characters.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }

            // Check for an existing username.
            if ($this->userModel->findByUsername($username)) {
                $error = "Username already exists.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }

            // UserModel::register() must hash the password.
            try {
                $this->userModel->register(
                    $username,
                    $password,
                    $full_name
                );

                header(
                    "Location: index.php?action=login",
                    true,
                    303
                );
                exit;

            } catch (PDOException $e) {
                error_log("LinkUp registration error: " . $e->getMessage());

                $error = "Registration could not be completed. Please try again.";
                require __DIR__ . "/../views/auth/register.php";
                return;
            }
        }

        require __DIR__ . "/../views/auth/register.php";
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = trim($_POST["username"] ?? "");
            $password = $_POST["password"] ?? "";

            if ($username === "" || $password === "") {
                $error = "Please enter your username and password.";
                require __DIR__ . "/../views/auth/login.php";
                return;
            }

            try {
                $user = $this->userModel->findByUsername($username);

                if (
                    $user &&
                    password_verify($password, $user["password"])
                ) {
                    // Prevent session fixation after login.
                    session_regenerate_id(true);

                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["username"] = $user["username"];

                    header(
                        "Location: index.php?action=home",
                        true,
                        303
                    );
                    exit;
                }

                $error = "Invalid username or password.";
                require __DIR__ . "/../views/auth/login.php";
                return;

            } catch (PDOException $e) {
                error_log("LinkUp login error: " . $e->getMessage());

                $error = "Login is temporarily unavailable. Please try again.";
                require __DIR__ . "/../views/auth/login.php";
                return;
            }
        }

        require __DIR__ . "/../views/auth/login.php";
    }

    public function logout()
    {
        // Prevent the browser from reusing cached private pages.
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

        // Remove session data.
        $_SESSION = [];

        // Remove the session cookie.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                [
                    "expires" => time() - 42000,
                    "path" => $params["path"],
                    "domain" => $params["domain"],
                    "secure" => $params["secure"],
                    "httponly" => $params["httponly"],
                    "samesite" => $params["samesite"] ?? "Lax"
                ]
            );
        }

        // Destroy the session.
        session_destroy();

        header(
            "Location: index.php?action=login",
            true,
            303
        );
        exit;
    }
}
