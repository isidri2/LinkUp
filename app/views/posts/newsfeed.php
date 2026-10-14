<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Newsfeed</title>

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<nav class="navbar">

    <h2>LinkUp</h2>

    <div>

        <span>
            Welcome,
            <?= htmlspecialchars($_SESSION["username"]) ?>
        </span>

        <a href="index.php?action=create_post">
            Create Post
        </a>

        <a href="index.php?action=logout">
            Logout
        </a>

    </div>

</nav>


<div class="feed-container">

    <h1>Newsfeed</h1>

    <?php if (empty($posts)): ?>

        <p class="no-posts">
            No posts yet. Be the first to post!
        </p>

    <?php endif; ?>


    <?php foreach ($posts as $post): ?>

        <div class="post">

            <div class="post-header">

                <strong>
                    <?= htmlspecialchars($post["full_name"]) ?>
                </strong>

                <span>
                    @<?= htmlspecialchars($post["username"]) ?>
                </span>

            </div>


            <div class="post-date">

                <?= htmlspecialchars($post["created_at"]) ?>

            </div>


            <div class="post-content">

                <?= nl2br(
                    htmlspecialchars($post["content"])
                ) ?>

            </div>


            <?php if (
                $post["user_id"] == $_SESSION["user_id"]
            ): ?>

                <div class="post-actions">

                    <a href="index.php?action=edit_post&id=<?= $post["id"] ?>">
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

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>