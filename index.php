<?php require_once "includes/header.php"; ?>

<?php require_once "includes/sidebar.php"; ?>

<main id="main" class="main">

    <?php
    $user_sql = "SELECT * FROM `user` WHERE `user`.`id` = 7";
    $result = mysqli_query($conn, $user_sql);
    $data = mysqli_fetch_assoc($result);
    ?>
    <div class="pagetitle">
        <h1>Profile</h1>
    </div><!-- End Page Title -->
    <?php
    $image_sql = "SELECT * FROM `images`";
    $image_result = mysqli_query($conn, $image_sql);
    $image_data = mysqli_fetch_assoc($image_result);
    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?=$image_data['filepath']?>" alt="Profile" class="rounded-circle">
                        <h2><?= $data["name"] ?></h2>
                        <h3><?= $data["title"] ?></h3>
                        <div class="social-links mt-2">
                            <a href="<?= $data[
                                "twitter"
                            ] ?>" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="<?= $data[
                                "facebook"
                            ] ?>" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="<?= $data[
                                "instagram"
                            ] ?>" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="<?= $data[
                                "linkdein"
                            ] ?>" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            <a href="<?= $data[
                                "github"
                            ] ?>" target="_blank" class="github"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-bold"><?= $data[
                                    "description"
                                ] ?></p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?= $data[
                                        "name"
                                    ] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8"><?= $data[
                                        "email"
                                    ] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8"><?= $data[
                                        "title"
                                    ] ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">birthday</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo date(
                                            "d M Y",
                                            strtotime($data["birthday"])
                                        ); ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">phone</div>
                                    <div class="col-lg-9 col-md-8"><?= $data[
                                        "phone"
                                    ] ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">address</div>
                                    <div class="col-lg-9 col-md-8"><?= $data[
                                        "address"
                                    ] ?></div>
                                </div>



                            </div>




                            <?php if (isset($_POST["save_changes"])) {
                                $name = $_POST["fullName"];
                                $title = $_POST["title"];
                                $place = $_POST["place"];
                                $facebook = $_POST["facebook"];
                                $twitter = $_POST["twitter"];
                                $instagram = $_POST["instagram"];
                                $linkdein = $_POST["linkdein"];
                                $github = $_POST["github"];
                                $slogan = $_POST["slogan"];
                                $birthday = $_POST["birthday"];
                                $website = $_POST["website"];
                                $phone = $_POST["phone"];
                                $city = $_POST["city"];
                                $age = $_POST["age"];
                                $degree = $_POST["degree"];
                                $freelance = $_POST["freelance"];
                                $certification = $_POST["certification"];
                                $description = $_POST["description"];
                                $skills = $_POST["skills"];
                                $address = $_POST["address"];
                                $country = $_POST["country"];

                                $userupdate_sql = "UPDATE `user` SET
    `name` = ?,
    `title` = ?,
    `place` = ?,
    `facebook` = ?,
    `twitter` = ?,
    `instagram` = ?,
    `linkdein` = ?,
    `github` = ?,
    `slogan` = ?,
    `birthday` = ?,
    `website` = ?,
    `phone` = ?,
    `city` = ?,
    `age` = ?,
    `degree` = ?,
    `freelance` = ?,
    `certification` = ?,
    `description` = ?,
    `skills` = ?,
    `address` = ?,
    `country` = ?
    WHERE `id` = 7";
                                $stmt = mysqli_prepare($conn, $userupdate_sql);
                                if ($stmt) {
                                    mysqli_stmt_bind_param(
                                        $stmt,
                                        "sssssssssssssssssssss",
                                        $name,
                                        $title,
                                        $place,
                                        $facebook,
                                        $twitter,
                                        $instagram,
                                        $linkdein,
                                        $github,
                                        $slogan,
                                        $birthday,
                                        $website,
                                        $phone,
                                        $city,
                                        $age,
                                        $degree,
                                        $freelance,
                                        $certification,
                                        $description,
                                        $skills,
                                        $address,
                                        $country
                                    );
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);
                                } else {
                                    // Handle the error if the statement preparation fails
                                    echo "Error: " . mysqli_error($conn);
                                }
                            } ?>


                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="post" action="<?php echo htmlspecialchars(
                                    $_SERVER["PHP_SELF"]
                                ); ?>">


                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control" id="fullName"
                                                value="<?= $data["name"] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourtitle" class="col-md-4 col-lg-3 col-form-label">title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="title" class="form-control" id="yourtitle " value="<?= $data[
                                                    "title"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourplace" class="col-md-4 col-lg-3 col-form-label">place</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="place" class="form-control" id="yourplace" value="<?= $data[
                                                    "place"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourfacebook"
                                            class="col-md-4 col-lg-3 col-form-label">facebook</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="facebook" class="form-control" id="yourfacebook"
                                                value="<?= $data[
                                                    "facebook"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourtwitter"
                                            class="col-md-4 col-lg-3 col-form-label">twitter</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="twitter" class="form-control" id="yourtwitter"
                                                value="<?= $data[
                                                    "twitter"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourinstagram"
                                            class="col-md-4 col-lg-3 col-form-label">instagram</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="instagram" class="form-control" id="yourinstagram"
                                                value="<?= $data[
                                                    "instagram"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourlinkdein"
                                            class="col-md-4 col-lg-3 col-form-label">linkdein</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="linkdein" class="form-control" id="yourlinkdein"
                                                value="<?= $data[
                                                    "linkdein"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourgithub" class="col-md-4 col-lg-3 col-form-label">github</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="github" class="form-control" id="yourgithub" value="<?= $data[
                                                    "github"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourslogan" class="col-md-4 col-lg-3 col-form-label">slogan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="slogan" class="form-control" id="yourslogan" value="<?= $data[
                                                    "slogan"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourbirthday"
                                            class="col-md-4 col-lg-3 col-form-label">birthday</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="birthday" class="form-control" id="yourbirthday"
                                                value="<?= $data[
                                                    "birthday"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourwebsite"
                                            class="col-md-4 col-lg-3 col-form-label">website</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="website" class="form-control" id="yourwebsite"
                                                value="<?= $data[
                                                    "website"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourphone" class="col-md-4 col-lg-3 col-form-label">phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="phone" class="form-control" id="yourphone" value="<?= $data[
                                                    "phone"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourcity" class="col-md-4 col-lg-3 col-form-label">city</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="city" class="form-control" id="yourcity" value="<?= $data[
                                                    "city"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourage" class="col-md-4 col-lg-3 col-form-label">age</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="age" class="form-control" id="yourage" value="<?= $data[
                                                    "age"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourdegree" class="col-md-4 col-lg-3 col-form-label">degree</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="degree" class="form-control" id="yourdegree" value="<?= $data[
                                                    "degree"
                                                ] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="yourfreelance"
                                            class="col-md-4 col-lg-3 col-form-label">freelance</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" name="freelance" class="form-control" id="yourfreelance"
                                                value="<?= $data[
                                                    "freelance"
                                                ] ?>" required>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourcertification"
                                                class="col-md-4 col-lg-3 col-form-label">certification</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="certification" class="form-control"
                                                    id="yourcertification" value="<?= $data[
                                                        "certification"
                                                    ] ?>" required>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourdescription"
                                                class="col-md-4 col-lg-3 col-form-label">description</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="description" class="form-control"
                                                    id="yourdescription" value="<?= $data[
                                                        "description"
                                                    ] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourskills"
                                                class="col-md-4 col-lg-3 col-form-label">skills</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="skills" class="form-control" id="yourskills"
                                                    value="<?= $data[
                                                        "skills"
                                                    ] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="youraddress"
                                                class="col-md-4 col-lg-3 col-form-label">address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="address" class="form-control" id="youraddress"
                                                    value="<?= $data[
                                                        "address"
                                                    ] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="yourcountry"
                                                class="col-md-4 col-lg-3 col-form-label">country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="country" class="form-control" id="yourcountry"
                                                    value="<?= $data[
                                                        "country"
                                                    ] ?>" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="save_changes" class="btn btn-primary">
                                                Save
                                                Changes</button>
                                        </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->




<?php require_once "includes/footer.php"; ?>