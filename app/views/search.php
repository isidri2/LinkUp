<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LinkUp - Search</title>

    <link rel="stylesheet" href="assets/style.css">

    <style>
        body {
            margin: 0;
            background: #f4f6f8;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .search-page {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .search-page-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .search-page-header h2 {
            margin: 8px 0;
            font-size: 32px;
        }

        .search-description {
            color: #666;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-form input {
            flex: 1;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .search-form button {
            padding: 14px 25px;
            border: none;
            border-radius: 8px;
            background: #1877f2;
            color: white;
            cursor: pointer;
        }

        .search-welcome-card,
        .search-results-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .search-welcome-card {
            text-align: center;
        }

        .search-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-user {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .search-avatar,
        .search-post-avatar {
            width: 45px;
            height: 45px;
            min-width: 45px;
            border-radius: 50%;
            overflow: hidden;
            background: #1877f2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .search-user-info {
            flex: 1;
        }

        .search-user-info p {
            margin: 4px 0;
            color: #666;
        }

        .search-user-label {
            font-size: 12px;
            color: #777;
        }

        .search-post-card {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .search-post-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-post-date {
            color: #888;
            font-size: 13px;
        }

        .search-post-content {
            margin-top: 15px;
            line-height: 1.6;
        }

        @media (max-width: 600px) {
            .search-form {
                flex-direction: column;
            }

            .search-form button {
                width: 100%;
            }
        }

        /* ==========================================
   SEARCH DARK MODE
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

body.dark-mode .search-page {
    color: #ffffff !important;
}

body.dark-mode .search-page-header h2 {
    color: #ffffff !important;
}

body.dark-mode .search-description {
    color: #aaaaaa !important;
}

body.dark-mode .search-form input {
    background: #222222 !important;
    color: #ffffff !important;
    border-color: #555555 !important;
}

body.dark-mode .search-form input::placeholder {
    color: #aaaaaa !important;
}

body.dark-mode .search-welcome-card,
body.dark-mode .search-results-section {
    background: #1e1e1e !important;
    color: #ffffff !important;
}

body.dark-mode .search-results-section h3,
body.dark-mode .search-results-section span {
    color: #ffffff !important;
}

body.dark-mode .search-user {
    border-color: #444444 !important;
}

body.dark-mode .search-user-info strong,
body.dark-mode .search-user-info p {
    color: #ffffff !important;
}

body.dark-mode .search-user-label {
    color: #aaaaaa !important;
}

body.dark-mode .search-post-card {
    border-color: #444444 !important;
}

body.dark-mode .search-post-author strong,
body.dark-mode .search-post-author p {
    color: #ffffff !important;
}

body.dark-mode .search-post-date {
    color: #aaaaaa !important;
}

body.dark-mode .search-post-content {
    color: #ffffff !important;
}

body.dark-mode .dark-mode-button {
    background: transparent !important;
    color: #ffffff !important;
    border: none !important;
}

.navbar > div {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

.navbar .dark-mode-button {
    order: 4 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
}

</style>
</head>

<body>

<nav class="navbar">
    <h1>LinkUp</h1>

    <div>
    <a href="index.php?action=home">Newsfeed</a>
    <a href="index.php?action=search" class="active">Search</a>
    <a href="index.php?action=profile">Profile</a>

    <button
        type="button"
        id="darkModeToggle"
        class="dark-mode-button"
    >🌙</button>

    <a href="index.php?action=logout">Logout</a>
    </div>
    </nav>

<main class="search-page">

    <header class="search-page-header">
        <h2>Search LinkUp</h2>
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

        <div class="search-results-section">

            <div class="search-section-heading">
                <h3>People</h3>
                <span><?= count($users ?? []) ?> results</span>
            </div>

            <?php if (empty($users)): ?>

                <p>No people found.</p>

            <?php else: ?>

                <?php foreach ($users as $user): ?>

                    <?php
                    $fullName = $user["full_name"] ?? "User";
                    $username = $user["username"] ?? "user";

                    $imageName = basename(
                        trim($user["profile_image"] ?? "")
                    );
                    ?>

                    <div class="search-user">

                        <div class="search-avatar">

                            <?php if ($imageName !== ""): ?>

                                <img
                                    src="uploads/<?= htmlspecialchars(
                                        $imageName,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                    alt="Profile"
                                >

                            <?php else: ?>

                                <?= htmlspecialchars(
                                    strtoupper(substr($fullName, 0, 1)),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

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

                                <p>
                                    <?= htmlspecialchars(
                                        $user["bio"],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>


        <div class="search-results-section">

            <div class="search-section-heading">
                <h3>Posts</h3>
                <span><?= count($posts ?? []) ?> results</span>
            </div>

            <?php if (empty($posts)): ?>

                <p>No posts found.</p>

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

        </div>

    <?php else: ?>

        <div class="search-welcome-card">

            <h3>Search LinkUp</h3>

            <p>
                Search for people by name or username,
                or search for posts using a keyword.
            </p>

        </div>

    <?php endif; ?>

</main>

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