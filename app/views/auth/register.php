<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Register</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

<!-- DARK MODE BUTTON -->
<button
    type="button"
    id="themeToggle"
    class="dark-mode-button"
    style="position: fixed; top: 20px; right: 20px; z-index: 999;"
    title="Toggle Light/Dark Mode"
>
    🌙
</button>


<div class="login-page">

    <div class="login-card">

        <h1>LinkUp</h1>

        <p class="login-subtitle">
            Create your account and join LinkUp.
        </p>

        <h2>Register</h2>


        <?php if (isset($error)): ?>

            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>

        <?php endif; ?>


        <form method="POST">

            <label for="full_name">
                Full Name
            </label>

            <input
                type="text"
                id="full_name"
                name="full_name"
                placeholder="Enter your full name"
                required
            >


            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Choose a username"
                required
            >


            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Create a password"
                required
            >


            <button type="submit">
                Create Account
            </button>

        </form>


        <p class="register-text">

            Already have an account?

            <a href="index.php?action=login">
                Login
            </a>

        </p>

    </div>

</div>


<script>

    const themeToggle = document.getElementById("themeToggle");

    // Get saved theme
    const savedTheme = localStorage.getItem("linkup-theme");

    // Apply saved dark mode
    if (savedTheme === "dark") {

        document.body.classList.add("dark-mode");

        themeToggle.textContent = "☀️";

    }


    // Toggle Light / Dark Mode
    themeToggle.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {

            themeToggle.textContent = "☀️";

            localStorage.setItem("linkup-theme", "dark");

        } else {

            themeToggle.textContent = "🌙";

            localStorage.setItem("linkup-theme", "light");

        }

    });

</script>


</body>

</html>