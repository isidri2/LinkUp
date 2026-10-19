console.log("LinkUp loaded successfully.");

// DARK MODE TOGGLE


const darkModeToggle = document.getElementById("darkModeToggle");

if (darkModeToggle) {

    // Check saved dark mode setting
    if (localStorage.getItem("darkMode") === "enabled") {

        document.body.classList.add("dark-mode");

        darkModeToggle.textContent = "☀️ Light Mode";

    }


    // Toggle dark mode
    darkModeToggle.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");


        // Dark mode enabled
        if (document.body.classList.contains("dark-mode")) {

            localStorage.setItem(
                "darkMode",
                "enabled"
            );

            darkModeToggle.textContent =
                "☀️ Light Mode";

        }


        // Dark mode disabled
        else {

            localStorage.setItem(
                "darkMode",
                "disabled"
            );

            darkModeToggle.textContent =
                "🌙 Dark Mode";

        }

    });

}