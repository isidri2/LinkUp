<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Edit Profile</title>

    <link rel="stylesheet" href="assets/style.css">

    <!-- Cropper.js CSS -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"
    >

    <style>

        <style>

/* ==========================================
   EDIT PROFILE
   ========================================== */

.crop-container {
    display: none;
    margin-top: 20px;
}

.crop-container img {
    display: block;
    max-width: 100%;
    max-height: 400px;
}

.crop-buttons {
    margin-top: 15px;
    display: flex;
    gap: 10px;
}

.crop-buttons button {
    padding: 10px 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.crop-button {
    background: #1877f2;
    color: white;
}

.cancel-crop {
    background: #777;
    color: white;
}

.image-preview {
    margin-top: 15px;
    max-width: 150px;
    max-height: 150px;
    border-radius: 50%;
    object-fit: cover;
    display: none;
}

.image-info {
    margin-top: 8px;
    font-size: 13px;
    color: #777;
}


/* ==========================================
   NAVBAR
   ========================================== */

.navbar > div {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

.navbar > div > a:nth-child(1) {
    order: 1 !important;
}

.navbar > div > a:nth-child(2) {
    order: 2 !important;
}

.navbar > div > a:nth-child(3) {
    order: 3 !important;
}

.navbar > div > a[href*="logout"] {
    order: 4 !important;
}

.navbar > div > button.dark-mode-button {
    order: 5 !important;
}


/* ==========================================
   DARK MODE
   ========================================== */

body.dark-mode {
    background: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode .navbar {
    background: #1e1e1e !important;
}

body.dark-mode .navbar h1,
body.dark-mode .navbar a {
    color: #ffffff !important;
}


/* Form container */

body.dark-mode .form-container {
    background: #1e1e1e !important;
    color: #ffffff !important;
}


/* Headings */

body.dark-mode .form-container h1,
body.dark-mode .form-container h3 {
    color: #ffffff !important;
}


/* Labels */

body.dark-mode .form-container label {
    color: #ffffff !important;
}


/* Input */

body.dark-mode .form-container input[type="text"],
body.dark-mode .form-container textarea {
    background: #292929 !important;
    color: #ffffff !important;
    border-color: #555555 !important;
}


/* Placeholder */

body.dark-mode .form-container input::placeholder,
body.dark-mode .form-container textarea::placeholder {
    color: #aaaaaa !important;
}


/* File input */

body.dark-mode .form-container input[type="file"] {
    color: #ffffff !important;
}


/* Image information */

body.dark-mode .image-info {
    color: #aaaaaa !important;
}


/* Current photo text */

body.dark-mode .current-photo-text {
    color: #ffffff !important;
}


/* Crop container */

body.dark-mode .crop-container {
    background: #292929 !important;
    color: #ffffff !important;
    padding: 15px !important;
    border-radius: 8px !important;
}


/* Crop buttons */

body.dark-mode .crop-button {
    background: #1877f2 !important;
    color: #ffffff !important;
}

body.dark-mode .cancel-crop {
    background: #555555 !important;
    color: #ffffff !important;
}


/* Dark mode button */

body.dark-mode .dark-mode-button {
    background: transparent !important;
    color: #ffffff !important;
    border: none !important;
}


/* Back link */

body.dark-mode .back-link {
    color: #7db4ff !important;
}


/* Error */

body.dark-mode .error {
    color: #ff7777 !important;
}

</style>

    </style>

</head>


<body>


<nav class="navbar">

    <h1>LinkUp</h1>

    <div>

        <a href="index.php?action=home">
            Newsfeed
        </a>

        <a href="index.php?action=search">
            Search
        </a>

        <a href="index.php?action=profile">
            Profile
        </a>

        <a href="index.php?action=logout">
            Logout
        </a>

        <button
            type="button"
            id="darkModeToggle"
            class="dark-mode-button"
        >🌙</button>

    </div>

</nav>


<div class="form-container">

    <h1>Edit Profile</h1>


    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form
        method="POST"
        enctype="multipart/form-data"
        id="profileForm"
    >


        <label for="full_name">
            Full Name
        </label>

        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= htmlspecialchars($user["full_name"] ?? "") ?>"
            placeholder="Enter your full name"
            required
        >


        <label for="bio">
            Bio
        </label>

        <textarea
            id="bio"
            name="bio"
            placeholder="Write something about yourself..."
        ><?= htmlspecialchars($user["bio"] ?? "") ?></textarea>


        <label for="profile_image">
            Profile Photo
        </label>

        <input
            type="file"
            id="profile_image"
            name="profile_image"
            accept="image/jpeg,image/png,image/gif"
        >

        <p class="image-info">
            JPG, JPEG, PNG, or GIF. Maximum 5 MB.
        </p>


        <!-- Image preview -->

        <img
            id="imagePreview"
            class="image-preview"
            alt="Image Preview"
        >


        <!-- Cropping area -->

        <div
            class="crop-container"
            id="cropContainer"
        >

            <h3>Crop Your Profile Photo</h3>

            <img
                id="cropImage"
                alt="Image to crop"
            >

            <div class="crop-buttons">

                <button
                    type="button"
                    class="crop-button"
                    id="cropButton"
                >
                    Crop Image
                </button>

                <button
                    type="button"
                    class="cancel-crop"
                    id="cancelCrop"
                >
                    Cancel
                </button>

            </div>

        </div>


        <!-- Hidden cropped image -->

        <input
            type="hidden"
            name="cropped_image"
            id="croppedImage"
        >


        <?php if (!empty($user["profile_image"])): ?>

            <p class="current-photo-text">
                Current profile photo:
            </p>

            <img
                src="uploads/<?= htmlspecialchars($user["profile_image"]) ?>"
                class="edit-profile-image"
                alt="Current Profile Photo"
            >

        <?php endif; ?>


        <button type="submit">
            Save Changes
        </button>


    </form>


    <a
        href="index.php?action=profile"
        class="back-link"
    >
        ← Back to Profile
    </a>


</div>


<!-- Cropper.js -->

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js">
</script>


<script>

let cropper = null;

const imageInput =
    document.getElementById("profile_image");

const cropImage =
    document.getElementById("cropImage");

const cropContainer =
    document.getElementById("cropContainer");

const cropButton =
    document.getElementById("cropButton");

const cancelCrop =
    document.getElementById("cancelCrop");

const croppedImage =
    document.getElementById("croppedImage");

const imagePreview =
    document.getElementById("imagePreview");


/*
 * WHEN USER SELECTS AN IMAGE
 */

imageInput.addEventListener("change", function () {

    const file = this.files[0];

    if (!file) {
        return;
    }


    /*
     * CHECK FILE SIZE
     */

    if (file.size > 5 * 1024 * 1024) {

        alert("Image must not exceed 5 MB.");

        this.value = "";

        return;
    }


    /*
     * CHECK FILE TYPE
     */

    const allowedTypes = [
        "image/jpeg",
        "image/png",
        "image/gif"
    ];


    if (!allowedTypes.includes(file.type)) {

        alert(
            "Only JPG, JPEG, PNG, and GIF images are allowed."
        );

        this.value = "";

        return;
    }


    /*
     * READ IMAGE
     */

    const reader = new FileReader();


    reader.onload = function (event) {

        cropImage.src = event.target.result;

        cropContainer.style.display = "block";


        /*
         * DESTROY OLD CROPPER
         */

        if (cropper) {

            cropper.destroy();

        }


        /*
         * CREATE CROPPER
         */

        cropper = new Cropper(
            cropImage,
            {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: "move",
                autoCropArea: 1,
                responsive: true,
                background: false
            }
        );

    };


    reader.readAsDataURL(file);

});


/*
 * CROP IMAGE
 */

cropButton.addEventListener("click", function () {

    if (!cropper) {
        return;
    }


    const canvas =
        cropper.getCroppedCanvas({
            width: 500,
            height: 500
        });


    /*
     * SHOW CROPPED PREVIEW
     */

    imagePreview.src =
        canvas.toDataURL("image/jpeg", 0.9);

    imagePreview.style.display = "block";


    /*
     * STORE CROPPED IMAGE
     */

    croppedImage.value =
        canvas.toDataURL("image/jpeg", 0.9);


    /*
     * CLOSE CROPPER
     */

    cropContainer.style.display = "none";


    cropper.destroy();

    cropper = null;

});


/*
 * CANCEL CROPPING
 */

cancelCrop.addEventListener("click", function () {

    if (cropper) {

        cropper.destroy();

        cropper = null;

    }


    cropContainer.style.display = "none";

    imageInput.value = "";

    croppedImage.value = "";

    imagePreview.src = "";

    imagePreview.style.display = "none";

});

</script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const darkModeButton =
        document.getElementById("darkModeToggle");

    if (!darkModeButton) {
        return;
    }


    /* CHECK SAVED DARK MODE */

    if (
        localStorage.getItem("linkupDarkMode") === "enabled"
    ) {

        document.body.classList.add("dark-mode");

        darkModeButton.innerHTML = "☀️";

    } else {

        darkModeButton.innerHTML = "🌙";

    }


    /* TOGGLE DARK MODE */

    darkModeButton.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");


        if (
            document.body.classList.contains("dark-mode")
        ) {

            localStorage.setItem(
                "linkupDarkMode",
                "enabled"
            );

            darkModeButton.innerHTML = "☀️";

        } else {

            localStorage.setItem(
                "linkupDarkMode",
                "disabled"
            );

            darkModeButton.innerHTML = "🌙";

        }

    });

});

</script>

</body>

</html>