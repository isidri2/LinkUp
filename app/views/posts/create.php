<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Create Post</title>

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<div class="form-container">

    <h1>Create Post</h1>

    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form method="POST">

        <textarea
            name="content"
            placeholder="What's on your mind?"
            required
        ></textarea>


        <button type="submit">
            Post
        </button>

    </form>


    <br>

    <a href="index.php?action=home">
        Back to Newsfeed
    </a>

</div>

</body>
</html>