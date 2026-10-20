<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - My Profile</title>

    <!-- FAVICON -->
    <link
        rel="icon"
        type="image/png"
        href="/webpt2/LinkUp/public/assets/logo-circle.png?v=2"
    >

    <link rel="stylesheet" href="assets/style.css">

    <style>

/* ==========================================
   NAVBAR
   ========================================== */

.navbar {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

/* LOGO + LINKUP */

.navbar .brand {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.navbar .brand img {
    width: 40px !important;
    height: 40px !important;
    object-fit: contain !important;
    display: block !important;
}

.navbar .brand h1 {
    margin: 0 !important;
}

/* NAVIGATION LINKS */

.navbar > div:not(.brand) {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

/* ==========================================
   EDIT PROFILE BUTTON
   ========================================== */

.edit-profile-button {
    display: inline-block !important;
    margin-top: 15px !important;
    padding: 11px 22px !important;

    background: #222 !important;
    color: #ffffff !important;

    border: 1px solid #222 !important;
    border-radius: 10px !important;

    text-decoration: none !important;
    font-size: 15px !important;
    font-weight: 600 !important;

    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

.edit-profile-button:hover {
    background: #444 !important;
    border-color: #444 !important;
    transform: translateY(-1px);
}

/* DARK MODE BUTTON */

.navbar .dark-mode-button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;

    margin: 0 !important;
    padding: 5px !important;

    background: transparent !important;
    border: none !important;

    font-size: 20px !important;
    cursor: pointer !important;
}


/* ==========================================
   PROFILE COVER PHOTO
   ========================================== */

.profile-cover {
    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 20px;
    background: #e5e7eb;
}

.profile-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.profile-cover-default {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
    font-size: 18px;
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

body.dark-mode .profile-container {
    background: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode .profile-card,
body.dark-mode .profile-posts {
    background: #1e1e1e !important;
    color: #ffffff !important;
}

body.dark-mode .profile-card h2,
body.dark-mode .profile-posts h2 {
    color: #ffffff !important;
}

body.dark-mode .username {
    color: #bbbbbb !important;
}

body.dark-mode .bio {
    color: #ffffff !important;
}

body.dark-mode .post {
    background: #292929 !important;
    color: #ffffff !important;
    border-color: #444444 !important;
}

body.dark-mode .post strong,
body.dark-mode .post span,
body.dark-mode .post p,
body.dark-mode .post-content {
    color: #ffffff !important;
}

body.dark-mode .post-date {
    color: #aaaaaa !important;
}

body.dark-mode .post-actions a {
    color: #7db4ff !important;
}

body.dark-mode .empty-result {
    background: #292929 !important;
    color: #ffffff !important;
}

body.dark-mode .dark-mode-button {
    background: transparent !important;
    color: #ffffff !important;
    border: none !important;
}

    </style>

</head>

<body>


<!-- ==========================================
     NAVBAR
     ========================================== -->

<nav class="navbar">

    <!-- LOGO -->

    <div class="brand">

        <img
            src="assets/logo.png"
            alt="LinkUp Logo"
        >

        <h1>LinkUp</h1>

    </div>


    <!-- NAVIGATION -->

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


<!-- ==========================================
     PROFILE CONTAINER
     ========================================== -->

<div class="profile-container">


    <!-- PROFILE COVER -->

    <?php if (!empty($user["cover_photo"])): ?>

        <div class="profile-cover">

            <img
                src="uploads/<?= htmlspecialchars($user["cover_photo"]) ?>"
                alt="Profile Cover Photo"
            >

        </div>

    <?php else: ?>

        <div class="profile-cover profile-cover-default">

            <span>
                Profile Cover
            </span>

        </div>

    <?php endif; ?>


    <!-- ==========================================
         PROFILE CARD
         ========================================== -->

    <div class="profile-card">


        <!-- PROFILE IMAGE -->

        <?php if (!empty($user["profile_image"])): ?>

            <img
                src="uploads/<?= htmlspecialchars($user["profile_image"]) ?>"
                class="profile-image"
                alt="Profile Photo"
            >

        <?php else: ?>

            <div class="profile-avatar">

                <?= strtoupper(
                    substr(
                        $user["full_name"],
                        0,
                        1
                    )
                ) ?>

            </div>

        <?php endif; ?>


        <!-- FULL NAME -->

        <h2>

            <?= htmlspecialchars(
                $user["full_name"]
            ) ?>

        </h2>


        <!-- USERNAME -->

        <p class="username">

            @<?= htmlspecialchars(
                $user["username"]
            ) ?>

        </p>


        <!-- BIO -->

        <?php if (!empty($user["bio"])): ?>

            <p class="bio">

                <?= nl2br(
                    htmlspecialchars(
                        $user["bio"]
                    )
                ) ?>

            </p>

        <?php else: ?>

            <p class="bio">

                No bio yet.

            </p>

        <?php endif; ?>


        <!-- EDIT PROFILE -->

        <a
            href="index.php?action=edit_profile"
            class="edit-profile-button"
        >
            Edit Profile
        </a>


    </div>


    <!-- ==========================================
         MY POSTS
         ========================================== -->

    <div class="profile-posts">

        <h2>
            My Posts
        </h2>


        <?php if (empty($posts)): ?>

            <div class="empty-result">

                <p>
                    You have no posts yet.
                </p>

                <a
                    href="index.php?action=create_post"
                    class="create-post-button"
                >
                    Create Your First Post
                </a>

            </div>

        <?php else: ?>


            <?php foreach ($posts as $post): ?>

                <div class="post">


                    <!-- POST HEADER -->

                    <div class="post-header">

                        <strong>

                            <?= htmlspecialchars(
                                $post["full_name"]
                            ) ?>

                        </strong>

                        <span>

                            @<?= htmlspecialchars(
                                $post["username"]
                            ) ?>

                        </span>

                    </div>


                    <!-- POST DATE -->

                    <p class="post-date">

                        <?= htmlspecialchars(
                            $post["created_at"]
                        ) ?>

                    </p>


                    <!-- POST CONTENT -->

                    <div class="post-content">

                        <?= nl2br(
                            htmlspecialchars(
                                $post["content"]
                            )
                        ) ?>

                    </div>


                    <!-- POST ACTIONS -->

                    <div class="post-actions">

                        <a
                            href="index.php?action=edit_post&id=<?= $post["id"] ?>"
                        >
                            Edit
                        </a>


                        <a
                            href="index.php?action=delete_post&id=<?= $post["id"] ?>"
                            onclick="return confirm('Delete this post?')"
                        >
                            Delete
                        </a>

                    </div>


                </div>

            <?php endforeach; ?>


        <?php endif; ?>


    </div>


</div>


<!-- ==========================================
     DARK MODE SCRIPT
     ========================================== -->

<script>

document.addEventListener("DOMContentLoaded", function () {


    const darkModeButton =
        document.getElementById("darkModeToggle");


    if (!darkModeButton) {
        return;
    }


    /* LOAD SAVED DARK MODE */

    if (
        localStorage.getItem("linkupDarkMode") === "enabled"
    ) {

        document.body.classList.add("dark-mode");

        darkModeButton.innerHTML = "☀️";

    } else {

        darkModeButton.innerHTML = "🌙";

    }


    /* DARK MODE BUTTON */

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