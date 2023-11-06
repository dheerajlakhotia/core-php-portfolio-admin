<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Query to retrieve data from the "contact" table
$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

// Check if a row should be deleted
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    // Delete the row with the specified ID
    $deleteSql = "DELETE FROM contact WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteSql);
    mysqli_stmt_bind_param($stmt, "i", $deleteId);
    mysqli_stmt_execute($stmt);

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Redirect back to the page to refresh the table
    header("Location: contact.php");
}

?>

<main id="main" class="main">

    <section class="section contact">
        <div class="col-xl-6 order-first order-xl-last mx-auto">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Operation</th> <!-- New column for delete operation -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["subject"] . "</td>";
                            echo "<td>" . $row["message"] . "</td>";
                            echo '<td><a href="?delete=' . $row["id"] . '" class="btn btn-danger">Delete</a></td>'; // Delete button
                            echo "</tr>";
                        }
                    } else {
                        echo "No data found in the contact table.";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>




    </section>

</main><!-- End #main -->

<?php require_once 'includes/footer.php' ?>