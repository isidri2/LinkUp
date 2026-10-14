<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Login</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

<div class="login-page">

    <div class="login-card">

        <h1>LinkUp</h1>

        <p class="login-subtitle">
            Connect. Share. LinkUp.
        </p>

        <h2>Login</h2>

        <?php if (isset($error)): ?>

            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>

        <?php endif; ?>


        <form method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Enter your username"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >


            <button type="submit">
                Login
            </button>

        </form>


        <p class="register-text">

            Don't have an account?

            <a href="index.php?action=register">
                Register
            </a>

        </p>

    </div>

</div>

</body>

</html>