<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Register</title>

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<div class="auth-container">

    <h1>LinkUp</h1>

    <h2>Create Account</h2>

    <?php if (isset($error)): ?>

        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <input
            type="text"
            name="full_name"
            placeholder="Full Name"
            required
        >

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
            Register
        </button>

    </form>

    <p>
        Already have an account?

        <a href="index.php?action=login">
            Login
        </a>
    </p>

</div>

</body>
</html>