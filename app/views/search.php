
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp - Search</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<nav class="navbar">
    <h1>LinkUp</h1>
    <div>
        <a href="index.php?action=home">Newsfeed</a>
        <a href="index.php?action=search" class="active">Search</a>
        <a href="index.php?action=profile">Profile</a>
        <a href="index.php?action=logout">Logout</a>
    </div>
</nav>

<main class="search-page">

    <header class="search-page-header">
        <p class="search-eyebrow">DISCOVER YOUR COMMUNITY</p>
        <h2>Search LinkUp<span>.</span></h2>
        <p class="search-description">
            Find people and discover posts from your community.
        </p>
    </header>

    <form method="GET" action="index.php" class="search-form">
        <input type="hidden" name="action" value="search">

        <input
            type="text"
            name="keyword"
            placeholder="Search by name, username, or post..."
            value="<?= htmlspecialchars($keyword ?? '', ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <button type="submit">Search</button>
    </form>

    <?php if (!empty($keyword)): ?>

        <div class="search-heading">
            <h3>
                Results for
                "<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>"
            </h3>
            <p>People and posts matching your search.</p>
        </div>

        <!-- PEOPLE RESULTS -->
        <section class="search-results-section">

            <div class="search-section-heading">
                <h3>People</h3>
                <span><?= count($users ?? []) ?> results</span>
            </div>

            <?php if (empty($users)): ?>

                <div class="search-empty-card">
                    <div class="search-empty-icon">◎</div>
                    <h4>No people found</h4>
                    <p>Try searching with another name or username.</p>
                </div>

            <?php else: ?>

                <div class="search-user-list">

                    <?php foreach ($users as $user): ?>

                        <?php
                        $fullName = $user["full_name"]
                            ?? $user["username"]
                            ?? "User";

                        $username = $user["username"] ?? "user";

                        // Keep only the filename, not a stored directory path.
                        $imageName = basename(
                            trim($user["profile_image"] ?? "")
                        );

                        // This project is served from /HTML/LinkUp/public.
                        $imagePath = "/HTML/LinkUp/public/uploads/"
                            . rawurlencode($imageName);
                        ?>

                        <article class="search-user">

                            <div class="search-avatar">

                                <?php if ($imageName !== ""): ?>

                                    <img
                                        src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') ?>'s profile picture"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    >

                                    <span
                                        class="avatar-fallback"
                                        style="display:none;"
                                    >
                                        <?= htmlspecialchars(
                                            strtoupper(substr($fullName, 0, 1)),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                <?php else: ?>

                                    <span class="avatar-fallback">
                                        <?= htmlspecialchars(
                                            strtoupper(substr($fullName, 0, 1)),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                <?php endif; ?>

                            </div>

                            <div class="search-user-info">

                                <strong>
                                    <?= htmlspecialchars(
                                        $fullName,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </strong>

                                <p>
                                    @<?= htmlspecialchars(
                                        $username,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>

                                <?php if (!empty($user["bio"])): ?>
                                    <p class="search-user-bio">
                                        <?= htmlspecialchars(
                                            $user["bio"],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </p>
                                <?php endif; ?>

                            </div>

                            <span class="search-user-label">MEMBER</span>

                        </article>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </section>

        <!-- POST RESULTS -->
        <section class="search-results-section">

            <div class="search-section-heading">
                <h3>Posts</h3>
                <span><?= count($posts ?? []) ?> results</span>
            </div>

            <?php if (empty($posts)): ?>

                <div class="search-empty-card">
                    <div class="search-empty-icon">✳</div>
                    <h4>No posts found</h4>
                    <p>Try a different keyword to discover more posts.</p>
                </div>

            <?php else: ?>

                <?php foreach ($posts as $post): ?>

                    <article class="search-post-card">

                        <div class="search-post-author">

                            <div class="search-post-avatar">
                                <?= htmlspecialchars(
                                    strtoupper(
                                        substr(
                                            $post["full_name"] ?? "U",
                                            0,
                                            1
                                        )
                                    ),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </div>

                            <div>
                                <strong>
                                    <?= htmlspecialchars(
                                        $post["full_name"] ?? "User",
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </strong>

                                <p>
                                    @<?= htmlspecialchars(
                                        $post["username"] ?? "user",
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>
                            </div>

                        </div>

                        <p class="search-post-date">
                            <?= htmlspecialchars(
                                $post["created_at"] ?? "",
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                        <div class="search-post-content">
                            <?= nl2br(
                                htmlspecialchars(
                                    $post["content"] ?? "",
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ) ?>
                        </div>

                    </article>

                <?php endforeach; ?>

            <?php endif; ?>

        </section>

    <?php else: ?>

        <div class="search-welcome-card">
            <div class="search-welcome-symbol">⌕</div>
            <h3>Who are you looking for?</h3>
            <p>
                Search for people by name or username,
                or enter a keyword to find posts.
            </p>
        </div>

    <?php endif; ?>

</main>

</body>
</html>