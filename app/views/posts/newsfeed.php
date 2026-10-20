<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Newsfeed</title>

    <link
        rel="icon"
        type="image/png"
        href="/webpt2/LinkUp/public/assets/logo-circle.png?v=2"
    >

    <link rel="stylesheet" href="assets/style.css">

    <script src="assets/script.js"></script>

    <style>

/* ==========================================
   LINKUP NEWSFEED DARK MODE
   ========================================== */

body.dark-mode {
    background: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode .navbar {
    background: #1e1e1e !important;
}

body.dark-mode .navbar h1,
body.dark-mode .navbar span,
body.dark-mode .navbar a {
    color: #ffffff !important;
}

body.dark-mode .feed-container {
    background: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode .feed-container h2 {
    color: #ffffff !important;
}

body.dark-mode .post {
    background: #1e1e1e !important;
    color: #ffffff !important;
    border-color: #333333 !important;
}

body.dark-mode .post strong,
body.dark-mode .post span,
body.dark-mode .post p,
body.dark-mode .post h4,
body.dark-mode .post-content {
    color: #ffffff !important;
}

body.dark-mode .post-date {
    color: #aaaaaa !important;
}

body.dark-mode .comments {
    color: #ffffff !important;
}

body.dark-mode .comment {
    background: #292929 !important;
    color: #ffffff !important;
    border-color: #444444 !important;
}

body.dark-mode .comment strong,
body.dark-mode .comment span,
body.dark-mode .comment p {
    color: #ffffff !important;
}

body.dark-mode .comment-form input {
    background: #222222 !important;
    color: #ffffff !important;
    border-color: #555555 !important;
}

body.dark-mode .comment-form input::placeholder {
    color: #aaaaaa !important;
}

body.dark-mode .post-actions a {
    color: #7db4ff !important;
}

body.dark-mode .like-count {
    color: #ffffff !important;
}

body.dark-mode .empty-result {
    background: #1e1e1e !important;
    color: #ffffff !important;
}


/* ==========================================
   DARK MODE BUTTON
   ========================================== */

.dark-mode-button {
    border: none !important;
    background: transparent !important;
    color: inherit !important;
    cursor: pointer !important;
    font-size: 18px !important;
    padding: 5px 8px !important;
}

body.dark-mode .dark-mode-button {
    background: #292929 !important;
    color: #ffffff !important;
}


/* ==========================================
   NAVBAR
   ========================================== */

.navbar {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}


/* LOGO */

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


/* NAVIGATION */

.navbar > div:not(.brand) {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}


/* DARK MODE BUTTON */

.navbar .dark-mode-button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
}


/* ==========================================
   BODY
   ========================================== */

</style>

</head>

<body>


<!-- ==========================================
     NAVBAR
     ========================================== -->

<nav class="navbar">

    <div class="brand">

        <img
            src="assets/logo.png"
            alt="LinkUp Logo"
        >

        <h1>LinkUp</h1>

    </div>


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
        >
            🌙
        </button>

    </div>

</nav>


<!-- ==========================================
     NEWSFEED
     ========================================== -->

<div class="feed-container">

    <h2>Newsfeed</h2>


    <a
        href="index.php?action=create_post"
        class="create-post-button"
    >
        Create Post
    </a>


    <?php if (empty($posts)): ?>

        <div class="empty-result">

            <p>No posts yet.</p>

        </div>

    <?php endif; ?>


    <?php foreach ($posts as $post): ?>

        <div class="post">


            <!-- POST HEADER -->

            <div class="post-header">


                <!-- PROFILE PICTURE -->

                <div style="
                    width: 46px;
                    height: 46px;
                    min-width: 46px;
                    max-width: 46px;
                    overflow: hidden;
                    border-radius: 50%;
                    flex-shrink: 0;
                ">

                    <img
                        src="<?= !empty($post['profile_image'])
                            ? 'uploads/' . rawurlencode(basename($post['profile_image']))
                            : 'assets/default-avatar.png' ?>"
                        alt="Profile picture"
                        style="
                            width: 46px !important;
                            height: 46px !important;
                            min-width: 46px !important;
                            max-width: 46px !important;
                            min-height: 46px !important;
                            max-height: 46px !important;
                            object-fit: cover !important;
                            display: block !important;
                            border-radius: 50% !important;
                        "
                        onerror="
                            this.onerror=null;
                            this.src='assets/default-avatar.png';
                        "
                    >

                </div>


                <!-- USER INFORMATION -->

                <div class="post-user-info">

                    <strong>

                        <?= htmlspecialchars(
                            $post["full_name"] ?? $post["username"]
                        ) ?>

                    </strong>

                    <span>

                        @<?= htmlspecialchars(
                            $post["username"]
                        ) ?>

                    </span>

                </div>

            </div>


            <!-- DATE -->

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


            <!-- EDIT AND DELETE -->

            <?php if (
                $post["user_id"] == $_SESSION["user_id"]
            ): ?>

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

            <?php endif; ?>


            <!-- LIKE -->

            <div class="like-section">

                <?php if ($postLiked[$post["id"]]): ?>

                    <a
                        href="index.php?action=unlike&id=<?= $post["id"] ?>"
                        class="like-button liked"
                    >
                        Unlike
                    </a>

                <?php else: ?>

                    <a
                        href="index.php?action=like&id=<?= $post["id"] ?>"
                        class="like-button"
                    >
                        Like
                    </a>

                <?php endif; ?>


                <span class="like-count">

                    <?= $postLikes[$post["id"]] ?>

                    Like<?= $postLikes[$post["id"]] == 1 ? "" : "s" ?>

                </span>

            </div>


            <!-- COMMENTS -->

            <div
                class="comments"
                data-post-id="<?= $post["id"] ?>"
            >

                <h4>Comments</h4>


                <?php

                $comments =
                    $postComments[$post["id"]] ?? [];

                ?>


                <?php if (empty($comments)): ?>

                    <p class="no-comments">
                        No comments yet.
                    </p>

                <?php else: ?>


                    <div class="comments-list">


                        <?php foreach ($comments as $comment): ?>


                            <div class="comment">


                                <strong>

                                    <?= htmlspecialchars(
                                        $comment["full_name"]
                                    ) ?>

                                </strong>


                                <span>

                                    @<?= htmlspecialchars(
                                        $comment["username"]
                                    ) ?>

                                </span>


                                <p>

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $comment["content"]
                                        )
                                    ) ?>

                                </p>


                                <?php if (
                                    $comment["user_id"]
                                    == $_SESSION["user_id"]
                                ): ?>


                                    <a
                                        href="index.php?action=edit_comment&id=<?= $comment["id"] ?>"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        href="index.php?action=delete_comment&id=<?= $comment["id"] ?>"
                                        onclick="return confirm('Delete this comment?')"
                                    >
                                        Delete
                                    </a>


                                <?php endif; ?>


                            </div>


                        <?php endforeach; ?>


                    </div>


                <?php endif; ?>


                <!-- AJAX COMMENT FORM -->

                <form
                    class="ajax-comment-form comment-form"
                    data-post-id="<?= $post["id"] ?>"
                >

                    <input
                        type="text"
                        name="content"
                        placeholder="Write a comment..."
                        required
                    >


                    <button type="submit">
                        Comment
                    </button>


                    <p class="ajax-comment-message"></p>

                </form>


            </div>


        </div>


    <?php endforeach; ?>


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


    if (
        localStorage.getItem("linkupDarkMode") === "enabled"
    ) {

        document.body.classList.add("dark-mode");

        darkModeButton.innerHTML = "☀️";

    } else {

        darkModeButton.innerHTML = "🌙";

    }


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