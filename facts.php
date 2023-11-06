<?php require_once 'includes/header.php'?>
<?php require_once 'includes/sidebar.php' ?>

<main id="main" class="main">

    <?php
    if (isset($_POST['add'])) {
        $pre = $_POST['pre'];
        $post = $_POST['post'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $fact_sql =  "INSERT INTO counter(pre, post, title, description) VALUES('$pre', '$post', '$title', '$description')";
        $result = mysqli_query($conn, $fact_sql);
    }

    // Check if "Edit" button is clicked for editing a fact
    if (isset($_GET['type']) && $_GET['type'] === 'edit' && isset($_GET['id'])) {
        $factIdToEdit = $_GET['id'];

        // Fetch the fact data to populate the form
        $fetchFactQuery = "SELECT * FROM counter WHERE id = $factIdToEdit";
        $fetchFactResult = mysqli_query($conn, $fetchFactQuery);

        if ($fetchFactResult && mysqli_num_rows($fetchFactResult) > 0) {
            $factData = mysqli_fetch_assoc($fetchFactResult);
        }
    }

    // Check if "Update Fact" button is clicked for updating a fact
    if (isset($_POST['update'])) {
        $updatedPre = $_POST['pre'];
        $updatedPost = $_POST['post'];
        $updatedTitle = $_POST['title'];
        $updatedDescription = $_POST['description'];
        $factIdToEdit = $_POST['fact_id']; // Retrieve the fact ID from the hidden field

        // Ensure that $factIdToEdit is defined
        if (!empty($factIdToEdit)) {
            // Perform SQL query to update the fact
            $updateFactQuery = "UPDATE counter SET pre = '$updatedPre', post = '$updatedPost', title = '$updatedTitle', description = '$updatedDescription' WHERE id = $factIdToEdit";
            $updateFactResult = mysqli_query($conn, $updateFactQuery);

            if ($updateFactResult) {
                // Bootstrap Success Alert
                echo '<div class="alert alert-success" role="alert">
                        Fact has been updated successfully.
                      </div>';
            } else {
                // Bootstrap Error Alert
                echo '<div class="alert alert-danger" role="alert">
                        Error updating the fact: ' . mysqli_error($conn) . '
                      </div>';
            }
        } else {
            // Display an error message if $factIdToEdit is not defined
            echo '<div class="alert alert-danger" role="alert">
                    Error updating the fact: Fact ID not specified.
                  </div>';
        }
    }

    if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id'])) {
        $factIdToDelete = $_GET['id'];

        // Check if the fact ID exists in the database
        $checkFactQuery = "SELECT * FROM counter WHERE id = $factIdToDelete";
        $checkFactResult = mysqli_query($conn, $checkFactQuery);

        if ($checkFactResult && mysqli_num_rows($checkFactResult) > 0) {
            // Fact exists, so you can proceed with deletion
            $deleteFactQuery = "DELETE FROM counter WHERE id = $factIdToDelete";
            $deleteFactResult = mysqli_query($conn, $deleteFactQuery);

            if ($deleteFactResult) {
                // Bootstrap Success Alert
                echo '<div class="alert alert-success" role="alert">
                        Fact has been deleted successfully.
                      </div>';
            } else {
                // Bootstrap Error Alert
                echo '<div class="alert alert-danger" role="alert">
                        Error deleting the fact: ' . mysqli_error($conn) . '
                      </div>';
            }
        } else {
            // Bootstrap Info Alert
            echo '<div class="alert alert-info" role="alert">
                    Fact does not exist.
                  </div>';
        }
    }
    ?>

    <!-- Display the form for adding/updating facts -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <label for="pre" class="col-md-4 col-lg-3 col-form-label">Pre value:</label>
            <div class="col-md-8 col-lg-9">
                <input name="pre" type="text" class="form-control" id="pre"
                    value="<?php echo isset($factData['pre']) ? $factData['pre'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="post" class="col-md-4 col-lg-3 col-form-label">Post Values:</label>
            <div class="col-md-8 col-lg-9">
                <input name="post" type="text" class="form-control" id="post"
                    value="<?php echo isset($factData['post']) ? $factData['post'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="title" class="col-md-4 col-lg-3 col-form-label">Title:</label>
            <div class="col-md-8 col-lg-9">
                <input name="title" type="text" class="form-control" id="title"
                    value="<?php echo isset($factData['title']) ? $factData['title'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description:</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control"
                    id="description"><?php echo isset($factData['description']) ? $factData['description'] : ''; ?></textarea>
            </div>
        </div>
        <input type="hidden" name="fact_id" value="<?php echo isset($factIdToEdit) ? $factIdToEdit : ''; ?>">

        <div class="text-center">
            <?php
            if (isset($factData)) {
                // Display "Update Fact" button when editing a fact
                echo '<button type="submit" name="update" class="btn btn-primary"> Update Fact</button>';
            } else {
                // Display "Add Fact" button when adding a new fact
                echo '<button type="submit" name="add" class="btn btn-primary"> Add Fact</button>';
            }
            ?>
        </div>

    </form>
    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Pre</th>
                <th scope="col">Post</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = "SELECT * FROM counter";
            $result = $conn->query($res);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["pre"]; ?></td>
                <td><?php echo $row["post"]; ?></td>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td>
                    <a href="facts.php?id=<?php echo $row["id"]; ?>&type=edit" class="btn btn-primary">Edit</a>
                    <a href="facts.php?id=<?php echo $row["id"]; ?>&type=delete" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</main>

<?php require_once 'includes/footer.php'?>