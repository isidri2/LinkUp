<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Edit Comment</title>

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

    <h1>Edit Comment</h1>


    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form method="POST">

        <label for="content">
            Comment
        </label>

        <textarea
            id="content"
            name="content"
            required
        ><?= htmlspecialchars($comment["content"] ?? "") ?></textarea>


        <button type="submit">
            Save Changes
        </button>

    </form>


    <a
        href="index.php?action=home"
        class="back-link"
    >
        ← Back to Newsfeed
    </a>

</div>


</body>

</html>