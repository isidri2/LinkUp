<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Edit Post</title>

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<div class="form-container">

    <h1>Edit Post</h1>

    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>


    <form method="POST">

        <textarea
            name="content"
            required
        ><?= htmlspecialchars($post["content"]) ?></textarea>


        <button type="submit">
            Update Post
        </button>

    </form>


    <br>

    <a href="index.php?action=home">
        Cancel
    </a>

</div>

</body>
</html>