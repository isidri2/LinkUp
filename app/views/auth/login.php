<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Login</title>

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<div class="auth-container">

    <h1>LinkUp</h1>

    <h2>Login</h2>

    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Username"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

    <p>
        Don't have an account?

        <a href="index.php?action=register">
            Register
        </a>
    </p>

</div>

</body>
</html>