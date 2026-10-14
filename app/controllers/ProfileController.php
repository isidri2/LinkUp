<?php

require_once __DIR__ . "/../models/UserModel.php";
require_once __DIR__ . "/../models/PostModel.php";

class ProfileController
{
    private $userModel;
    private $postModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
    }

    public function profile()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $user_id = $_SESSION["user_id"];

        $user = $this->userModel->findById($user_id);

        $allPosts = $this->postModel->getAllPosts();

        $posts = [];

        foreach ($allPosts as $post) {

            if ($post["user_id"] == $user_id) {

                $posts[] = $post;

            }

        }

        require "../app/views/profile/profile.php";
    }


    public function edit()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?action=login");
            exit;
        }

        $user_id = $_SESSION["user_id"];

        $user = $this->userModel->findById($user_id);


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $full_name = trim($_POST["full_name"]);
            $bio = trim($_POST["bio"]);

            $profile_image = $user["profile_image"];


            if (empty($full_name)) {

                $error = "Full name cannot be empty.";

                require "../app/views/profile/edit_profile.php";

                return;
            }


            /*
             * PROFILE PHOTO UPLOAD
             */

            if (
                isset($_FILES["profile_image"]) &&
                $_FILES["profile_image"]["error"] == 0
            ) {

                $file = $_FILES["profile_image"];

                $fileName = $file["name"];
                $fileTmp = $file["tmp_name"];

                $fileExtension = strtolower(
                    pathinfo(
                        $fileName,
                        PATHINFO_EXTENSION
                    )
                );


                $allowedExtensions = [
                    "jpg",
                    "jpeg",
                    "png",
                    "gif"
                ];


                if (
                    !in_array(
                        $fileExtension,
                        $allowedExtensions
                    )
                ) {

                    $error = "Only JPG, JPEG, PNG, and GIF images are allowed.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }


                $newFileName =
                    "profile_" .
                    $user_id .
                    "_" .
                    time() .
                    "." .
                    $fileExtension;


                $uploadFolder =
                    __DIR__ .
                    "/../../public/uploads/";


                if (!is_dir($uploadFolder)) {

                    mkdir(
                        $uploadFolder,
                        0777,
                        true
                    );

                }


                $uploadPath =
                    $uploadFolder .
                    $newFileName;


                if (
                    move_uploaded_file(
                        $fileTmp,
                        $uploadPath
                    )
                ) {

                    $profile_image =
                        $newFileName;

                }

            }


            $this->userModel->updateProfile(
                $user_id,
                $full_name,
                $bio,
                $profile_image
            );


            header(
                "Location: index.php?action=profile"
            );

            exit;
        }


        require "../app/views/profile/edit_profile.php";
    }
}