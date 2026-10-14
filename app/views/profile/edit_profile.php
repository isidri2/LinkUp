<!DOCTYPE html>
<html>

<head>

    <title>LinkUp - Edit Profile</title>

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

    <h1>Edit Profile</h1>


    <?php if (isset($error)): ?>

        <p class="error">

            <?= htmlspecialchars($error) ?>

        </p>

    <?php endif; ?>


    <form
        method="POST"
        enctype="multipart/form-data"
    >

        <label for="full_name">
            Full Name
        </label>

        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= htmlspecialchars($user["full_name"] ?? "") ?>"
            placeholder="Enter your full name"
            required
        >


        <label for="bio">
            Bio
        </label>

        <textarea
            id="bio"
            name="bio"
            placeholder="Write something about yourself..."
        ><?= htmlspecialchars($user["bio"] ?? "") ?></textarea>


        <label for="profile_image">
            Profile Photo
        </label>

        <input
            type="file"
            id="profile_image"
            name="profile_image"
            accept="image/*"
        >


        <?php if (!empty($user["profile_image"])): ?>

            <p class="current-photo-text">
                Current profile photo:
            </p>

            <img
                src="uploads/<?= htmlspecialchars($user["profile_image"]) ?>"
                class="edit-profile-image"
                alt="Current Profile Photo"
            >

        <?php endif; ?>


        <button type="submit">
            Save Changes
        </button>

    </form>


    <a
        href="index.php?action=profile"
        class="back-link"
    >
        ← Back to Profile
    </a>

</div>


</body>

</html>