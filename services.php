<?php require_once 'includes/header.php'?>
<?php require_once 'includes/sidebar.php' ?>

<main id="main" class="main">

    <?php
    if (isset($_POST['add'])) {
        $icon = $_POST['icon'];
        $stitle = $_POST['stitle'];
        $sdescription = $_POST['sdescription'];

        // Use prepared statements to insert a new service
        $insertServiceQuery = "INSERT INTO services(icon, stitle, sdescription) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertServiceQuery);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sss", $icon, $stitle, $sdescription);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Bootstrap Success Alert
            echo '<div class="alert alert-success" role="alert">
                    Service has been added successfully.
                  </div>';
        } else {
            // Bootstrap Error Alert
            echo '<div class="alert alert-danger" role="alert">
                    Error adding the service: ' . mysqli_error($conn) . '
                  </div>';
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Check if "Edit" button is clicked for editing a service
    if (isset($_GET['type']) && $_GET['type'] === 'edit' && isset($_GET['id'])) {
        $serviceIdToEdit = $_GET['id'];

        // Fetch the service data to populate the form
        $fetchServiceQuery = "SELECT * FROM services WHERE id = $serviceIdToEdit";
        $fetchServiceResult = mysqli_query($conn, $fetchServiceQuery);

        if ($fetchServiceResult && mysqli_num_rows($fetchServiceResult) > 0) {
            $serviceData = mysqli_fetch_assoc($fetchServiceResult);
        }
    }

    // Check if "Update Service" button is clicked for updating a service
    if (isset($_POST['update'])) {
        $updatedIcon = $_POST['icon'];
        $updatedStitle = $_POST['stitle'];
        $updatedSdescription = $_POST['sdescription'];
        $serviceIdToEdit = $_POST['service_id']; // Retrieve the service ID from the hidden field

        // Ensure that $serviceIdToEdit is defined
        if (!empty($serviceIdToEdit)) {
            // Use prepared statements to update the service
            $updateServiceQuery = "UPDATE services SET icon = ?, stitle = ?, sdescription = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $updateServiceQuery);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssi", $updatedIcon, $updatedStitle, $updatedSdescription, $serviceIdToEdit);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Bootstrap Success Alert
                echo '<div class="alert alert-success" role="alert">
                        Service has been updated successfully.
                      </div>';
            } else {
                // Bootstrap Error Alert
                echo '<div class="alert alert-danger" role="alert">
                        Error updating the service: ' . mysqli_error($conn) . '
                      </div>';
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            // Display an error message if $serviceIdToEdit is not defined
            echo '<div class="alert alert-danger" role="alert">
                    Error updating the service: Service ID not specified.
                  </div>';
        }
    }

    if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id'])) {
        $serviceIdToDelete = $_GET['id'];

        // Check if the service ID exists in the database
        $checkServiceQuery = "SELECT * FROM services WHERE id = $serviceIdToDelete";
        $checkServiceResult = mysqli_query($conn, $checkServiceQuery);

        if ($checkServiceResult && mysqli_num_rows($checkServiceResult) > 0) {
            // Service exists, so you can proceed with deletion
            $deleteServiceQuery = "DELETE FROM services WHERE id = $serviceIdToDelete";
            $deleteServiceResult = mysqli_query($conn, $deleteServiceQuery);

            if ($deleteServiceResult) {
                // Bootstrap Success Alert
                echo '<div class="alert alert-success" role="alert">
                        Service has been deleted successfully.
                      </div>';
            } else {
                // Bootstrap Error Alert
                echo '<div class="alert alert-danger" role="alert">
                        Error deleting the service: ' . mysqli_error($conn) . '
                      </div>';
            }
        } else {
            // Bootstrap Info Alert
            echo '<div class="alert alert-info" role="alert">
                    Service does not exist.
                  </div>';
        }
    }
    ?>

    <!-- Display the form for adding/updating services -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <label for="icon" class="col-md-4 col-lg-3 col-form-label">Icon:</label>
            <div class="col-md-8 col-lg-9">
                <input name="icon" type="text" class="form-control" id="icon"
                    value="<?php echo isset($serviceData['icon']) ? $serviceData['icon'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="stitle" class="col-md-4 col-lg-3 col-form-label">Service Title:</label>
            <div class="col-md-8 col-lg-9">
                <input name="stitle" type="text" class="form-control" id="stitle"
                    value="<?php echo isset($serviceData['stitle']) ? $serviceData['stitle'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="sdescription" class="col-md-4 col-lg-3 col-form-label">Service Description:</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="sdescription" class="form-control"
                    id="sdescription"><?php echo isset($serviceData['sdescription']) ? $serviceData['sdescription'] : ''; ?></textarea>
            </div>
        </div>
        <input type="hidden" name="service_id" value="<?php echo isset($serviceIdToEdit) ? $serviceIdToEdit : ''; ?>">

        <div class="text-center">
            <?php
            if (isset($serviceData)) {
                // Display "Update Service" button when editing a service
                echo '<button type="submit" name="update" class="btn btn-primary"> Update Service</button>';
            } else {
                // Display "Add Service" button when adding a new service
                echo '<button type="submit" name="add" class="btn btn-primary"> Add Service</button>';
            }
            ?>
        </div>

    </form>
    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Icon</th>
                <th scope="col">Service Title</th>
                <th scope="col">Service Description</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = "SELECT * FROM services";
            $result = $conn->query($res);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["icon"]; ?></td>
                <td><?php echo $row["stitle"]; ?></td>
                <td><?php echo $row["sdescription"]; ?></td>
                <td>
                    <a href="services.php?id=<?php echo $row["id"]; ?>&type=edit" class="btn btn-primary">Edit</a>
                    <a href="services.php?id=<?php echo $row["id"]; ?>&type=delete" class="btn btn-danger">Delete</a>
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