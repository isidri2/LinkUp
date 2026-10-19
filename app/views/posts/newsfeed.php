<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Newsfeed</title>

    <link rel="stylesheet" href="assets/style.css">

    <style>

        /* ========================================
           DARK MODE BUTTON
        ======================================== */

        #darkModeToggle {
            padding: 8px 12px;
            margin-left: 5px;
            border: 1px solid #555;
            border-radius: 8px;
            background: #222;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        #darkModeToggle:hover {
            background: #333;
        }


        /* ========================================
           DARK MODE
        ======================================== */

        body.dark-mode {
            background-color: #121212 !important;
            color: #ffffff !important;
        }


        /* NAVBAR */

        body.dark-mode .navbar {
            background-color: #1e1e1e !important;
            color: #ffffff !important;
        }

        body.dark-mode .navbar h1 {
            color: #ffffff !important;
        }

        body.dark-mode .navbar span {
            color: #dddddd !important;
        }

        body.dark-mode .navbar a {
            color: #ffffff !important;
        }


        /* FEED */

        body.dark-mode .feed-container {
            color: #ffffff !important;
        }

        body.dark-mode .feed-container h2 {
            color: #ffffff !important;
        }


        /* POSTS */

        body.dark-mode .post {
            background-color: #1e1e1e !important;
            color: #ffffff !important;
            border-color: #333333 !important;
        }


        /* POST USER */

        body.dark-mode .post-user-info strong {
            color: #ffffff !important;
        }

        body.dark-mode .post-user-info span {
            color: #aaaaaa !important;
        }


        /* POST DATE */

        body.dark-mode .post-date {
            color: #aaaaaa !important;
        }


        /* POST CONTENT */

        body.dark-mode .post-content {
            color: #eeeeee !important;
        }


        /* POST ACTIONS */

        body.dark-mode .post-actions a {
            color: #bbbbbb !important;
        }


        /* LIKE */

        body.dark-mode .like-count {
            color: #cccccc !important;
        }

        body.dark-mode .like-button {
            color: #ffffff !important;
        }


        /* COMMENTS */

        body.dark-mode .comments {
            border-color: #333333 !important;
            color: #ffffff !important;
        }

        body.dark-mode .comments h4 {
            color: #ffffff !important;
        }

        body.dark-mode .comments > p {
            color: #aaaaaa !important;
        }


        /* COMMENT */

        body.dark-mode .comment {
            background-color: #252525 !important;
            border-color: #383838 !important;
            color: #ffffff !important;
        }

        body.dark-mode .comment strong {
            color: #ffffff !important;
        }

        body.dark-mode .comment span {
            color: #aaaaaa !important;
        }

        body.dark-mode .comment p {
            color: #dddddd !important;
        }

        body.dark-mode .comment a {
            color: #bbbbbb !important;
        }


        /* COMMENT INPUT */

        body.dark-mode .comment-form input {
            background-color: #252525 !important;
            color: #ffffff !important;
            border-color: #444444 !important;
        }

        body.dark-mode .comment-form input::placeholder {
            color: #999999 !important;
        }

        body.dark-mode .comment-form button {
            background-color: #ffffff !important;
            color: #111111 !important;
        }


        /* CREATE POST BUTTON */

        body.dark-mode .create-post-button {
            background-color: #ffffff !important;
            color: #111111 !important;
        }


        /* EMPTY RESULT */

        body.dark-mode .empty-result {
            background-color: #1e1e1e !important;
            color: #ffffff !important;
            border-color: #333333 !important;
        }

    </style>

</head>


<body>


<!-- ========================================
     NAVBAR
======================================== -->

<nav class="navbar">

    <h1>
        LinkUp
    </h1>


    <div>

        <span>
            Welcome,
            <?= htmlspecialchars($_SESSION["username"]) ?>
        </span>


        <a href="index.php?action=home">
            Newsfeed
        </a>


        <a href="index.php?action=search">
            Search
        </a>


        <a href="index.php?action=profile">
            Profile
        </a>


        <!-- DARK MODE BUTTON -->

        <button
            type="button"
            id="darkModeToggle"
        >
            🌙 Dark Mode
        </button>


        <a href="index.php?action=logout">
            Logout
        </a>

    </div>

</nav>



<!-- ========================================
     NEWSFEED
======================================== -->

<div class="feed-container">


    <h2>
        Newsfeed
    </h2>


    <!-- CREATE POST -->

    <a
        href="index.php?action=create_post"
        class="create-post-button"
    >
        Create Post
    </a>



    <!-- NO POSTS -->

    <?php if (empty($posts)): ?>

        <div class="empty-result">

            <p>
                No posts yet.
            </p>

        </div>

    <?php endif; ?>



    <!-- ========================================
         POSTS
    ======================================== -->

    <?php foreach ($posts as $post): ?>


        <div class="post">


            <!-- POST HEADER -->

            <div class="post-header">


                <!-- PROFILE IMAGE -->

                <div
                    style="
                        width: 46px;
                        height: 46px;
                        min-width: 46px;
                        max-width: 46px;
                        overflow: hidden;
                        border-radius: 50%;
                        flex-shrink: 0;
                    "
                >

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



            <!-- ========================================
                 EDIT / DELETE
            ======================================== -->

            <?php if (
                $post["user_id"] ==
                $_SESSION["user_id"]
            ): ?>


                <div class="post-actions">


                    <a
                        href="index.php?action=edit_post&id=<?= $post["id"] ?>"
                    >
                        Edit
                    </a>


                    <a
                        href="index.php?action=delete_post&id=<?= $post["id"] ?>"

                        onclick="
                            return confirm(
                                'Delete this post?'
                            )
                        "
                    >
                        Delete
                    </a>


                </div>


            <?php endif; ?>



            <!-- ========================================
                 LIKE
            ======================================== -->

            <div class="like-section">


                <?php if (
                    $postLiked[$post["id"]]
                ): ?>


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



            <!-- ========================================
                 COMMENTS
            ======================================== -->

            <div class="comments">


                <h4>
                    Comments
                </h4>



                <?php

                $comments =
                    $postComments[$post["id"]];

                ?>



                <!-- NO COMMENTS -->

                <?php if (empty($comments)): ?>


                    <p>
                        No comments yet.
                    </p>


                <?php else: ?>


                    <!-- COMMENT LIST -->

                    <?php foreach (
                        $comments as $comment
                    ): ?>


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



                            <!-- COMMENT EDIT / DELETE -->

                            <?php if (
                                $comment["user_id"] ==
                                $_SESSION["user_id"]
                            ): ?>


                                <a
                                    href="index.php?action=edit_comment&id=<?= $comment["id"] ?>"
                                >
                                    Edit
                                </a>


                                <a
                                    href="index.php?action=delete_comment&id=<?= $comment["id"] ?>"

                                    onclick="
                                        return confirm(
                                            'Delete this comment?'
                                        )
                                    "
                                >
                                    Delete
                                </a>


                            <?php endif; ?>


                        </div>


                    <?php endforeach; ?>


                <?php endif; ?>



                <!-- ========================================
                     ADD COMMENT
                ======================================== -->

                <form
                    method="POST"
                    action="index.php?action=create_comment"
                    class="comment-form"
                >


                    <input
                        type="hidden"
                        name="post_id"
                        value="<?= $post["id"] ?>"
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


                </form>


            </div>


        </div>


    <?php endforeach; ?>


</div>



<!-- ========================================
     DARK MODE JAVASCRIPT
======================================== -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {


        const darkModeButton =
            document.getElementById(
                "darkModeToggle"
            );


        if (!darkModeButton) {

            console.log(
                "Dark mode button not found."
            );

            return;

        }



        /* CHECK SAVED DARK MODE */

        const savedMode =
            localStorage.getItem(
                "darkMode"
            );


        if (
            savedMode === "enabled"
        ) {

            document.body.classList.add(
                "dark-mode"
            );

            darkModeButton.textContent =
                "☀️ Light Mode";

        }



        /* BUTTON CLICK */

        darkModeButton.addEventListener(
            "click",
            function () {


                document.body.classList.toggle(
                    "dark-mode"
                );



                /* DARK MODE ON */

                if (
                    document.body.classList.contains(
                        "dark-mode"
                    )
                ) {


                    localStorage.setItem(
                        "darkMode",
                        "enabled"
                    );


                    darkModeButton.textContent =
                        "☀️";


                }



                /* DARK MODE OFF */

                else {


                    localStorage.setItem(
                        "darkMode",
                        "disabled"
                    );


                    darkModeButton.textContent =
                        "🌙";

                }


            }
        );


    }
);

</script>


</body>

</html>