<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - My Profile</title>

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


</body>

</html>