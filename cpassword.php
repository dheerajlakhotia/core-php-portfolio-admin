<?php require_once "includes/header.php"; ?>
<?php require_once "includes/sidebar.php"; ?>

<main id="main" class="main">
    <?php


// Check if the user is logged in (you should have some form of authentication)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include your database connection or user data retrieval logic here
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'portfolio';

// Create a MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $reenter_password = $_POST['reenter_password'];

    // Verify that the current password matches the user's actual current password
    // You should retrieve the user's hashed password from your database and compare it with the provided current password
    $user_id = $_SESSION['user_id']; // Assuming you have stored user ID in the session

    // Retrieve the user's hashed password from the database
    // Replace 'your_query_to_get_password' with the actual SQL query
    $get_password_query = "SELECT password FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($get_password_query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the current password
        if (password_verify($current_password, $hashed_password)) {
            // Current password is correct

            // Check if the new password and re-entered password match
            if ($new_password === $reenter_password) {
                // Hash the new password
                $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                // Update the user's password in the database
                // Replace 'your_query_to_update_password' with the actual SQL query
                $update_query = "UPDATE user SET password = ? WHERE id = ?";
                $update_stmt = $mysqli->prepare($update_query);
                $update_stmt->bind_param('si', $new_password_hash, $user_id);
                $update_stmt->execute();

                // Display a Bootstrap alert for success
                    echo '<div class="alert alert-success" role="alert">Password changed successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">New password and re-entered password do not match.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Current password is incorrect.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">User not found.</div>';
        }
}
    ?>


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="cpassword.php">
                                <h2 class="mb-4">Change Password</h2>

                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Current Password</label>
                                    <input name="current_password" type="password" class="form-control"
                                        id="currentPassword" autocomplete="off" required>
                                </div>

                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input name="new_password" type="password" class="form-control" id="newPassword"
                                        autocomplete="off" required>
                                </div>

                                <div class="mb-4">
                                    <label for="renewPassword" class="form-label">Re-enter New Password</label>
                                    <input name="reenter_password" type="password" class="form-control"
                                        id="renewPassword" autocomplete="off" required>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>



<?php require_once "includes/footer.php"; ?>