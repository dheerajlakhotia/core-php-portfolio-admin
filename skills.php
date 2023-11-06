<?php require_once 'includes/header.php'?>
<?php require_once 'includes/sidebar.php' ?>

<main id="main" class="main">

    <?php
    if (isset($_POST['add'])) {
        $sname = $_POST['sname'];
        $pre = $_POST['pre'];
        $post = $_POST['post'];

        $skill_sql =  "INSERT INTO skills(sname, pre, post) VALUES('$sname','$pre', '$post')";
        $result = mysqli_query($conn, $skill_sql);
    }

    // Check if "Edit" button is clicked for editing a skill
    if (isset($_GET['type']) && $_GET['type'] === 'edit' && isset($_GET['id'])) {
        $skillIdToEdit = $_GET['id'];

        // Fetch the skill data to populate the form
        $fetchSkillQuery = "SELECT * FROM skills WHERE id = $skillIdToEdit";
        $fetchSkillResult = mysqli_query($conn, $fetchSkillQuery);

        if ($fetchSkillResult && mysqli_num_rows($fetchSkillResult) > 0) {
            $skillData = mysqli_fetch_assoc($fetchSkillResult);
        }
    }

    // Check if "Update Skill" button is clicked for updating a skill
   if (isset($_POST['update'])) {
    $updatedSname = $_POST['sname'];
    $updatedPre = $_POST['pre'];
    $updatedPost = $_POST['post'];
    $skillIdToEdit = $_POST['skill_id']; // Retrieve the skill ID from the hidden field

    // Ensure that $skillIdToEdit is defined
    if (!empty($skillIdToEdit)) {
        // Perform SQL query to update the skill
        $updateSkillQuery = "UPDATE skills SET sname = '$updatedSname', pre = '$updatedPre', post = '$updatedPost' WHERE id = $skillIdToEdit";
        $updateSkillResult = mysqli_query($conn, $updateSkillQuery);

        if ($updateSkillResult) {
            // Bootstrap Success Alert
            echo '<div class="alert alert-success" role="alert">
                    Skill has been updated successfully.
                  </div>';
        } else {
            // Bootstrap Error Alert
            echo '<div class="alert alert-danger" role="alert">
                    Error updating the skill: ' . mysqli_error($conn) . '
                  </div>';
        }
    } else {
        // Display an error message if $skillIdToEdit is not defined
        echo '<div class="alert alert-danger" role="alert">
                Error updating the skill: Skill ID not specified.
              </div>';
    }
}

    if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id'])) {
        $skillIdToDelete = $_GET['id'];

        // Check if the skill ID exists in the database
        $checkSkillQuery = "SELECT * FROM skills WHERE id = $skillIdToDelete";
        $checkSkillResult = mysqli_query($conn, $checkSkillQuery);

        if ($checkSkillResult && mysqli_num_rows($checkSkillResult) > 0) {
            // Skill exists, so you can proceed with deletion
            $deleteSkillQuery = "DELETE FROM skills WHERE id = $skillIdToDelete";
            $deleteSkillResult = mysqli_query($conn, $deleteSkillQuery);

            if ($deleteSkillResult) {
                // Bootstrap Success Alert
                echo '<div class="alert alert-success" role="alert">
                        Skill has been deleted successfully.
                      </div>';
            } else {
                // Bootstrap Error Alert
                echo '<div class="alert alert-danger" role="alert">
                        Error deleting the skill: ' . mysqli_error($conn) . '
                      </div>';
            }
        } else {
            // Bootstrap Info Alert
            echo '<div class="alert alert-info" role="alert">
                    Skill does not exist.
                  </div>';
        }
    }
    ?>

    <!-- Display the form for adding/updating skills -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Skill Name:</label>
            <div class="col-md-8 col-lg-9">
                <input name="sname" type="text" class="form-control" id="fullName"
                    value="<?php echo isset($skillData['sname']) ? $skillData['sname'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Pre value:</label>
            <div class="col-md-8 col-lg-9">
                <input name="pre" type="text" class="form-control" id="fullName"
                    value="<?php echo isset($skillData['pre']) ? $skillData['pre'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Post Values:</label>
            <div class="col-md-8 col-lg-9">

                <input name="post" type="text" class="form-control" id="fullName"
                    value="<?php echo isset($skillData['post']) ? $skillData['post'] : ''; ?>">
            </div>
        </div>
        <input type="hidden" name="skill_id" value="<?php echo isset($skillIdToEdit) ? $skillIdToEdit : ''; ?>">

        <div class="text-center">
            <?php
            if (isset($skillData)) {
                // Display "Update Skill" button when editing a skill
                echo '<button type="submit" name="update" class="btn btn-primary"> Update Skill</button>';
            } else {
                // Display "Add Skill" button when adding a new skill
                echo '<button type="submit" name="add" class="btn btn-primary"> Add Skill</button>';
            }
            ?>
        </div>

    </form>
    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Skill Name</th>
                <th scope="col">Pre</th>
                <th scope="col">Post</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = "SELECT * FROM skills";
            $result = $conn->query($res);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["sname"]; ?></td>
                <td><?php echo $row["pre"]; ?></td>
                <td><?php echo $row["post"]; ?></td>
                <td>
                    <a href="skills.php?id=<?php echo $row["id"]; ?>&type=edit" class="btn btn-primary">Edit</a>
                    <a href="skills.php?id=<?php echo $row["id"]; ?>&type=delete" class="btn btn-danger">Delete</a>
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