<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Create Post</title>

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


<div class="form-container">

    <h1>Create Post</h1>

    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form method="POST">

        <label>What's on your mind?</label>

        <textarea
            name="content"
            placeholder="Write something..."
            required
        ></textarea>


        <button type="submit">
            Publish Post
        </button>

    </form>


    <br>


    <a href="index.php?action=home">
        ← Back to Newsfeed
    </a>

</div>

</body>

</html>