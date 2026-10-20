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

            $full_name = trim($_POST["full_name"] ?? "");
            $bio = trim($_POST["bio"] ?? "");

            $profile_image = $user["profile_image"] ?? "";
            $cover_photo = $user["cover_photo"] ?? "";


            /*
             * CHECK FULL NAME
             */

            if (empty($full_name)) {

                $error = "Full name cannot be empty.";

                require "../app/views/profile/edit_profile.php";

                return;
            }


            /*
             * CHECK CROPPED IMAGE
             */

            if (!empty($_POST["cropped_image"])) {

                $croppedImage = $_POST["cropped_image"];


                /*
                 * CHECK BASE64 FORMAT
                 */

                if (
                    preg_match(
                        '/^data:image\/jpeg;base64,/',
                        $croppedImage
                    )
                ) {

                    /*
                     * REMOVE BASE64 HEADER
                     */

                    $croppedImage = preg_replace(
                        '/^data:image\/jpeg;base64,/',
                        "",
                        $croppedImage
                    );


                    /*
                     * DECODE IMAGE
                     */

                    $imageData = base64_decode(
                        $croppedImage,
                        true
                    );


                    if ($imageData === false) {

                        $error = "Invalid cropped image.";

                        require "../app/views/profile/edit_profile.php";

                        return;
                    }


                    /*
                     * CHECK IMAGE SIZE
                     */

                    if (strlen($imageData) > 5 * 1024 * 1024) {

                        $error = "Cropped image is too large.";

                        require "../app/views/profile/edit_profile.php";

                        return;
                    }


                    /*
                     * VERIFY IMAGE
                     */

                    $imageInfo = getimagesizefromstring(
                        $imageData
                    );


                    if ($imageInfo === false) {

                        $error = "Invalid image data.";

                        require "../app/views/profile/edit_profile.php";

                        return;
                    }


                    /*
                     * CREATE UPLOAD FOLDER
                     */

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


                    /*
                     * CREATE SAFE FILE NAME
                     */

                    $newFileName =
                        "profile_" .
                        $user_id .
                        "_" .
                        time() .
                        ".jpg";


                    $uploadPath =
                        $uploadFolder .
                        $newFileName;


                    /*
                     * SAVE CROPPED IMAGE
                     */

                    if (
                        file_put_contents(
                            $uploadPath,
                            $imageData
                        ) === false
                    ) {

                        $error = "Failed to save the cropped image.";

                        require "../app/views/profile/edit_profile.php";

                        return;
                    }


                    /*
                     * UPDATE PROFILE IMAGE
                     */

                    $profile_image =
                        $newFileName;

                }

            }


            /*
             * NORMAL FILE UPLOAD
             *
             * This is used if no cropped image
             * was created.
             */

            elseif (
                isset($_FILES["profile_image"]) &&
                $_FILES["profile_image"]["error"] != UPLOAD_ERR_NO_FILE
            ) {

                $file = $_FILES["profile_image"];


                /*
                 * CHECK UPLOAD ERROR
                 */

                if ($file["error"] !== UPLOAD_ERR_OK) {

                    $error = "There was a problem uploading the image.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }


                /*
                 * MAXIMUM FILE SIZE
                 */

                $maxFileSize =
                    5 * 1024 * 1024;


                if ($file["size"] > $maxFileSize) {

                    $error = "Image size must not exceed 5 MB.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }


                /*
                 * CHECK FILE EXTENSION
                 */

                $fileName =
                    $file["name"];


                $fileExtension =
                    strtolower(
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

                    $error =
                        "Only JPG, JPEG, PNG, and GIF images are allowed.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }


                /*
                 * CHECK REAL IMAGE
                 */

                $imageInfo =
                    getimagesize(
                        $file["tmp_name"]
                    );


                if ($imageInfo === false) {

                    $error =
                        "The uploaded file is not a valid image.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }


                /*
                 * CREATE SAFE FILE NAME
                 */

                $newFileName =
                    "profile_" .
                    $user_id .
                    "_" .
                    time() .
                    "." .
                    $fileExtension;


                /*
                 * UPLOAD FOLDER
                 */

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


                /*
                 * SAVE IMAGE
                 */

                $uploadPath =
                    $uploadFolder .
                    $newFileName;


                if (
                    move_uploaded_file(
                        $file["tmp_name"],
                        $uploadPath
                    )
                ) {

                    $profile_image =
                        $newFileName;

                } else {

                    $error =
                        "Failed to save the uploaded image.";

                    require "../app/views/profile/edit_profile.php";

                    return;
                }
            }

            /*
            * COVER PHOTO UPLOAD
            */

        if (
        isset($_FILES["cover_photo"]) &&
        $_FILES["cover_photo"]["error"] != UPLOAD_ERR_NO_FILE
    ) {

        $coverFile = $_FILES["cover_photo"];

        // Check upload error
        if ($coverFile["error"] !== UPLOAD_ERR_OK) {
        $error = "There was a problem uploading the cover photo.";
        require "../app/views/profile/edit_profile.php";
        return;
    }

        // Maximum 5 MB
        if ($coverFile["size"] > 5 * 1024 * 1024) {
        $error = "Cover photo must not exceed 5 MB.";
        require "../app/views/profile/edit_profile.php";
        return;
    }

        // Check extension
        $coverExtension = strtolower(
        pathinfo(
            $coverFile["name"],
            PATHINFO_EXTENSION
        )
    );

        $allowedCoverExtensions = [
        "jpg",
        "jpeg",
        "png",
        "gif"
    ];

        if (!in_array($coverExtension, $allowedCoverExtensions)) {
        $error = "Only JPG, JPEG, PNG, and GIF cover photos are allowed.";
        require "../app/views/profile/edit_profile.php";
        return;
    }

    // Check if real image
    $coverImageInfo = getimagesize(
        $coverFile["tmp_name"]
    );

    if ($coverImageInfo === false) {
        $error = "The uploaded cover photo is not a valid image.";
        require "../app/views/profile/edit_profile.php";
        return;
    }

    // Upload folder
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

    // Safe filename
    $newCoverFileName =
        "cover_" .
        $user_id .
        "_" .
        time() .
        "." .
        $coverExtension;

    $coverUploadPath =
        $uploadFolder .
        $newCoverFileName;

    // Save cover photo
    if (
        move_uploaded_file(
            $coverFile["tmp_name"],
            $coverUploadPath
        )
    ) {
        $cover_photo = $newCoverFileName;
    } else {
        $error = "Failed to save the cover photo.";
        require "../app/views/profile/edit_profile.php";
        return;
    }
}

            /*
             * UPDATE PROFILE
             */

            $this->userModel->updateProfile(
                $user_id,
                $full_name,
                $bio,
                $profile_image,
                $cover_photo

            );


            /*
             * RETURN TO PROFILE
             */

            header(
                "Location: index.php?action=profile"
            );

            exit;
        }


        require "../app/views/profile/edit_profile.php";
    }
}