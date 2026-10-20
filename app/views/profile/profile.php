<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - My Profile</title>

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

.navbar > div {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

/* Newsfeed */
.navbar > div > a:nth-child(1) {
    order: 1 !important;
}

/* Search */
.navbar > div > a:nth-child(2) {
    order: 2 !important;
}

/* Profile */
.navbar > div > a:nth-child(3) {
    order: 3 !important;
}

/* Logout */
.navbar > div > a[href*="logout"] {
    order: 4 !important;
}

/* Dark Mode Button - RIGHT SIDE OF LOGOUT */
.navbar > div > button.dark-mode-button {
    order: 5 !important;

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

body.dark-mode .profile-posts,
body.dark-mode .profile-posts h2 {
    background: #1e1e1e !important;
    color: #ffffff !important;

}
</style>

</head>

<body>

<!---testing--->

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


<div class="profile-container">


    <!-- PROFILE CARD -->

    <div class="profile-card">


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


        <h2>

            <?= htmlspecialchars(
                $user["full_name"]
            ) ?>

        </h2>


        <p class="username">

            @<?= htmlspecialchars(
                $user["username"]
            ) ?>

        </p>


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


        <a
            href="index.php?action=edit_profile"
            class="edit-profile-button"
        >
            Edit Profile
        </a>

    </div>


    <!-- MY POSTS -->

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


                    <p class="post-date">

                        <?= htmlspecialchars(
                            $post["created_at"]
                        ) ?>

                    </p>


                    <div class="post-content">

                        <?= nl2br(
                            htmlspecialchars(
                                $post["content"]
                            )
                        ) ?>

                    </div>


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

        darkModeButton.innerHTML =
            "☀️";

    } else {

        darkModeButton.innerHTML =
            "🌙";

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

            darkModeButton.innerHTML =
                "☀️";

        } else {

            localStorage.setItem(
                "linkupDarkMode",
                "disabled"
            );

            darkModeButton.innerHTML =
                "🌙";

        }

    });

});
</script>

</body>

</html>