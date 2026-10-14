<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Search</title>

    <link rel="stylesheet" href="assets/style.css">

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

    </div>

</nav>


<div class="feed-container">

    <h2>Search LinkUp</h2>


    <form method="GET" class="search-form">

        <input
            type="hidden"
            name="action"
            value="search"
        >

        <input
            type="text"
            name="keyword"
            placeholder="Search users or posts..."
            value="<?= htmlspecialchars($keyword) ?>"
            required
        >

        <button type="submit">
            Search
        </button>

    </form>


    <?php if (!empty($keyword)): ?>

        <div class="search-heading">

            <h3>
                Search results for:
                "<?= htmlspecialchars($keyword) ?>"
            </h3>

        </div>


        <!-- USERS -->

        <h3 class="result-title">
            Users
        </h3>


        <?php if (empty($users)): ?>

            <div class="empty-result">

                <p>
                    No users found.
                </p>

            </div>

        <?php else: ?>

            <?php foreach ($users as $user): ?>

                <div class="search-user">

                    <div class="search-avatar">

                        <?= strtoupper(
                            substr($user["full_name"], 0, 1)
                        ) ?>

                    </div>


                    <div>

                        <strong>
                            <?= htmlspecialchars(
                                $user["full_name"]
                            ) ?>
                        </strong>

                        <p>
                            @<?= htmlspecialchars(
                                $user["username"]
                            ) ?>
                        </p>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>


        <!-- POSTS -->

        <h3 class="result-title">
            Posts
        </h3>


        <?php if (empty($posts)): ?>

            <div class="empty-result">

                <p>
                    No posts found.
                </p>

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

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    <?php else: ?>

        <div class="search-start">

            <h3>Search for something</h3>

            <p>
                Find users by name or username,
                or search for posts.
            </p>

        </div>

    <?php endif; ?>

</div>

</body>

</html>