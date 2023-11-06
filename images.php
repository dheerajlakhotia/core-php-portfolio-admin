<?php require_once "includes/header.php"; ?>
<?php require_once "includes/sidebar.php"; ?>

<main id="main" class="main">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploadDir = "uploads/";

        // Create the upload directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Check if profile image was uploaded
        if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
            $profileFileName = basename($_FILES["profile_image"]["name"]);
            $profileTargetPath = $uploadDir . "profile/" . $profileFileName;

            // Move the profile image to the target path
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $profileTargetPath)) {
                // Profile image uploaded successfully
            } else {
                echo "Error moving the profile image.";
            }
        } elseif ($_FILES["profile_image"]["error"] != UPLOAD_ERR_NO_FILE) {
            echo "Error uploading the profile image. Error code: " . $_FILES["profile_image"]["error"];
        }

        // Check if background image was uploaded
        if (isset($_FILES["background_image"]) && $_FILES["background_image"]["error"] == UPLOAD_ERR_OK) {
            $backgroundFileName = basename($_FILES["background_image"]["name"]);
            $backgroundTargetPath = $uploadDir . "background/" . $backgroundFileName;

            // Move the background image to the target path
            if (move_uploaded_file($_FILES["background_image"]["tmp_name"], $backgroundTargetPath)) {
                // Background image uploaded successfully
            } else {
                echo "Error moving the background image.";
            }
        } elseif ($_FILES["background_image"]["error"] != UPLOAD_ERR_NO_FILE) {
            echo "Error uploading the background image. Error code: " . $_FILES["background_image"]["error"];
        }

        // You can now insert the file paths into a database or perform other actions as needed
    }
    ?>
    <div class="container mt-5">
        <h2>Upload Profile Photo</h2>
        <form action="images.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_title">Title:</label>
                <input type="text" class="form-control" name="profile_title" required>
            </div>
            <div class="form-group">
                <label for="profile_description">Description:</label>
                <textarea class="form-control" name="profile_description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" class="form-control-file" name="profile_image" accept="image/*" required>
            </div>
            <img class="img-thumbnail" id="profile-image-preview" src="#" alt="Profile Image Preview">
            <button type="submit" class="btn btn-primary">Upload Profile Photo</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Upload Background Photo</h2>
        <form action="images.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="background_title">Title:</label>
                <input type="text" class="form-control" name="background_title" required>
            </div>
            <div class="form-group">
                <label for="background_description">Description:</label>
                <textarea class="form-control" name="background_description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="background_image">Background Image:</label>
                <input type="file" class="form-control-file" name="background_image" accept="image/*" required>
            </div>
            <img class="img-thumbnail" id="background-image-preview" src="#" alt="Background Image Preview">
            <button type="submit" class="btn btn-primary">Upload Background Photo</button>
        </form>
    </div>
</main><!-- End #main -->

<?php require_once "includes/footer.php"; ?>