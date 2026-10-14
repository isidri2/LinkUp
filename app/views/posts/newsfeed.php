<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Newsfeed</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>


<nav class="navbar">

    <h1>LinkUp</h1>

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

        <a href="index.php?action=logout">
            Logout
        </a>

    </div>

</nav>


<div class="feed-container">

    <h2>
        Newsfeed
    </h2>


    <a
        href="index.php?action=create_post"
        class="create-post-button"
    >
        Create Post
    </a>


    <?php if (empty($posts)): ?>

        <div class="empty-result">

            <p>
                No posts yet.
            </p>

        </div>

    <?php endif; ?>


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


            <!-- EDIT / DELETE -->

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
                        onclick="return confirm('Delete this post?')"
                    >
                        Delete
                    </a>

                </div>

            <?php endif; ?>


            <!-- LIKE -->

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


            <!-- COMMENTS -->

            <div class="comments">

                <h4>
                    Comments
                </h4>


                <?php
                $comments =
                    $postComments[$post["id"]];
                ?>


                <?php if (empty($comments)): ?>

                    <p>
                        No comments yet.
                    </p>

                <?php else: ?>


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
                                    onclick="return confirm('Delete this comment?')"
                                >
                                    Delete
                                </a>


                            <?php endif; ?>


                        </div>


                    <?php endforeach; ?>


                <?php endif; ?>


                <!-- ADD COMMENT -->

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


</body>

</html>