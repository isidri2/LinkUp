<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Login</title>

    <!-- LINKUP FAVICON -->
    <link
        rel="icon"
        type="image/png"
        href="/webpt2/LinkUp/public/assets/logo-circle.png?v=2"
    >

    <link rel="stylesheet" href="assets/style.css">

    <style>

/* ==========================================
   LOGIN DARK MODE
   ========================================== */

body.dark-mode {
    background: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode .login-page {
    background: #121212 !important;
}

body.dark-mode .login-card {
    background: #1e1e1e !important;
    color: #ffffff !important;
}

body.dark-mode .login-card h1,
body.dark-mode .login-card h2,
body.dark-mode .login-card p,
body.dark-mode .login-card label {
    color: #ffffff !important;
}

body.dark-mode .login-card .login-subtitle {
    color: #aaaaaa !important;
}

body.dark-mode .login-card input {
    background: #292929 !important;
    color: #ffffff !important;
    border-color: #555555 !important;
}

body.dark-mode .login-card input::placeholder {
    color: #aaaaaa !important;
}

body.dark-mode .login-card a {
    color: #ffffff !important;
}

body.dark-mode .login-card .error {
    color: #ff7777 !important;
}


/* ==========================================
   DARK MODE BUTTON
   ========================================== */

.dark-mode-button {
    position: fixed;

    top: 20px;
    right: 20px;

    width: 44px;
    height: 44px;

    border: none;
    border-radius: 50%;

    background: #ffffff;
    color: #111111;

    font-size: 20px;

    cursor: pointer;

    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);

    z-index: 9999;
}

body.dark-mode .dark-mode-button {
    background: #292929 !important;
    color: #ffffff !important;
}

</style>

</head>


<body>


<!-- DARK MODE BUTTON -->

<button
    type="button"
    id="darkModeToggle"
    class="dark-mode-button"
>
    🌙
</button>


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

            <label>
                Username
            </label>

            <input
                type="text"
                name="username"
                placeholder="Enter your username"
                required
            >


            <label>
                Password
            </label>

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


<!-- DARK MODE SCRIPT -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    const darkModeButton =
        document.getElementById("darkModeToggle");


    if (!darkModeButton) {
        return;
    }


    /* LOAD SAVED DARK MODE */

    if (
        localStorage.getItem("linkupDarkMode") === "enabled"
    ) {

        document.body.classList.add("dark-mode");

        darkModeButton.innerHTML = "☀️";

    } else {

        darkModeButton.innerHTML = "🌙";

    }


    /* DARK MODE BUTTON */

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