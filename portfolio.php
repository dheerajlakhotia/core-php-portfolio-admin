<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $category = $_POST['category']; // Assuming 'category' is a foreign key
    $client = $_POST['client'];
    $projectDate = $_POST['project_date'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $image1 = $_POST['image1'];
    $image2 = $_POST['image2'];
    $image3 = $_POST['image3'];

    $portfolioSkillsSql = "INSERT INTO portfolio_skills (title, category, client, project_date, url, description, image1, image2, image3) VALUES ('$title', $category, '$client', '$projectDate', '$url', '$description', '$image1', '$image2', '$image3')";
    $result = mysqli_query($conn, $portfolioSkillsSql);
}

// Check if "Edit" button is clicked for editing a portfolio skill
if (isset($_GET['type']) && $_GET['type'] === 'edit' && isset($_GET['id'])) {
    $portfolioToEdit = $_GET['id'];

    // Fetch the portfolio skill data to populate the form
    $fetchportfolioQuery = "SELECT * FROM portfolio_skills WHERE id = $portfolioToEdit";
    $fetchportfolioResult = mysqli_query($conn, $fetchportfolioQuery);

    if ($fetchportfolioResult && mysqli_num_rows($fetchportfolioResult) > 0) {
        $portfolioData = mysqli_fetch_assoc($fetchportfolioResult);
    }
}

// Check if "Update Skill" button is clicked for updating a skill
if (isset($_POST['update'])) {
    $updatedTitle = $_POST['title'];
    $updatedCategory = $_POST['category']; // Assuming 'category' is a foreign key
    $updatedClient = $_POST['client'];
    $updatedProjectDate = $_POST['project_date'];
    $updatedUrl = $_POST['url'];
    $updatedDescription = $_POST['description'];
    $updatedImage1 = $_POST['image1'];
    $updatedImage2 = $_POST['image2'];
    $updatedImage3 = $_POST['image3'];
    $portfolioToEdit = $_POST['skill_id']; // Retrieve the skill ID from the hidden field

    // Ensure that $portfolioToEdit is defined
    if (!empty($portfolioToEdit)) {
        // Perform SQL query to update the skill
        $updateSkillQuery = "UPDATE portfolio_skills SET title = '$updatedTitle', category = $updatedCategory, client = '$updatedClient', project_date = '$updatedProjectDate', url = '$updatedUrl', description = '$updatedDescription', image1 = '$updatedImage1', image2 = '$updatedImage2', image3 = '$updatedImage3' WHERE id = $portfolioToEdit";
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
        // Display an error message if $portfolioToEdit is not defined
        echo '<div class="alert alert-danger" role="alert">
                Error updating the skill: Skill ID not specified.
              </div>';
    }
}

if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['id'])) {
    $skillIdToDelete = $_GET['id'];

    // Check if the skill ID exists in the database
    $checkSkillQuery = "SELECT * FROM portfolio_skills WHERE id = $skillIdToDelete";
    $checkSkillResult = mysqli_query($conn, $checkSkillQuery);

    if ($checkSkillResult && mysqli_num_rows($checkSkillResult) > 0) {
        // Skill exists, so you can proceed with deletion
        $deleteSkillQuery = "DELETE FROM portfolio_skills WHERE id = $skillIdToDelete";
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

<main id="main" class="main">
    <!-- Display the form for adding/updating skills -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row mb-3">
            <label for="title" class="col-md-4 col-lg-3 col-form-label">Title:</label>
            <div class="col-md-8 col-lg-9">
                <input name="title" type="text" class="form-control" id="title"
                    value="<?php echo isset($skillData['title']) ? $skillData['title'] : ''; ?>">
            </div>
        </div>
        <!-- Assuming 'category' is a foreign key (you can replace 'select' with your actual select options) -->
        <div class="row mb-3">
            <label for="category" class="col-md-4 col-lg-3 col-form-label">Category:</label>
            <div class="col-md-8 col-lg-9">
                <select name="category" class="form-control" id="category">
                    <option value="1"
                        <?php echo (isset($skillData['category']) && $skillData['category'] == 1) ? 'selected' : ''; ?>>
                        Category 1</option>
                    <option value="2"
                        <?php echo (isset($skillData['category']) && $skillData['category'] == 2) ? 'selected' : ''; ?>>
                        Category 2</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="client" class="col-md-4 col-lg-3 col-form-label">Client:</label>
            <div class="col-md-8 col-lg-9">
                <input name="client" type="text" class="form-control" id="client"
                    value="<?php echo isset($skillData['client']) ? $skillData['client'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="project_date" class="col-md-4 col-lg-3 col-form-label">Project Date:</label>
            <div class="col-md-8 col-lg-9">
                <input name="project_date" type="date" class="form-control" id="project_date"
                    value="<?php echo isset($skillData['project_date']) ? $skillData['project_date'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="url" class="col-md-4 col-lg-3 col-form-label">URL:</label>
            <div class="col-md-8 col-lg-9">
                <input name="url" type="text" class="form-control" id="url"
                    value="<?php echo isset($skillData['url']) ? $skillData['url'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description:</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control"
                    id="description"><?php echo isset($skillData['description']) ? $skillData['description'] : ''; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="image1" class="col-md-4 col-lg-3 col-form-label">Image 1:</label>
            <div class="col-md-8 col-lg-9">
                <input name="image1" type="text" class="form-control" id="image1"
                    value="<?php echo isset($skillData['image1']) ? $skillData['image1'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image2" class="col-md-4 col-lg-3 col-form-label">Image 2:</label>
            <div class="col-md-8 col-lg-9">
                <input name="image2" type="text" class="form-control" id="image2"
                    value="<?php echo isset($skillData['image2']) ? $skillData['image2'] : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image3" class="col-md-4 col-lg-3 col-form-label">Image 3:</label>
            <div class="col-md-8 col-lg-9">
                <input name="image3" type="text" class="form-control" id="image3"
                    value="<?php echo isset($skillData['image3']) ? $skillData['image3'] : ''; ?>">
            </div>
        </div>
        <input type="hidden" name="skill_id" value="<?php echo isset($portfolioToEdit) ? $portfolioToEdit : ''; ?>">

        <div class="text-center">
            <?php
            if (isset($skillData)) {
                // Display "Update Skill" button when editing a skill
                echo '<button type="submit" name="update" class="btn btn-primary">Update Skill</button>';
            } else {
                // Display "Add Skill" button when adding a new skill
                echo '<button type="submit" name="add" class="btn btn-primary">Add Skill</button>';
            }
            ?>
        </div>
    </form>

    <table class="table table-striped my-5">
        <thead>
            <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Client</th>
                <th scope="col">Project Date</th>
                <th scope="col">URL</th>
                <th scope="col">Description</th>
                <th scope="col">Image 1</th>
                <th scope="col">Image 2</th>
                <th scope="col">Image 3</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = "SELECT * FROM portfolio_skills";
            $result = $conn->query($res);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["category"]; ?></td>
                <td><?php echo $row["client"]; ?></td>
                <td><?php echo $row["project_date"]; ?></td>
                <td><?php echo $row["url"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["image1"]; ?></td>
                <td><?php echo $row["image2"]; ?></td>
                <td><?php echo $row["image3"]; ?></td>
                <td>
                    <a href="portfolio_skills.php?id=<?php echo $row["id"]; ?>&type=edit"
                        class="btn btn-primary">Edit</a>
                    <a href="portfolio_skills.php?id=<?php echo $row["id"]; ?>&type=delete"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</main>

<?php require_once 'includes/footer.php' ?>