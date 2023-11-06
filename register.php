<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['caccount'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $title = $_POST["title"];
    $place = $_POST["place"];
    $facebook = $_POST["facebook"];
    $twitter = $_POST["twitter"];
    $instagram = $_POST["instagram"];
    $linkdein = $_POST["linkdein"];
    $github = $_POST["github"];
    $slogan = $_POST["slogan"];
    $birthday = $_POST["dob"];
    $website = $_POST["website"];
    $phone = $_POST["mobile"];
    $city = $_POST["city"];
    $age = $_POST["age"];
    $degree = $_POST["degree"];
    $freelance = $_POST["freelance"];
    $certification = $_POST["certificate"];
    $description = $_POST["description"];
    $skills = $_POST["skills"];
    $address = $_POST["address"];

    $sql = "INSERT INTO `user` (`name`, `email`, `password`, `title`, `place`, `facebook`, `twitter`, `instagram`, `linkdein`, `github`, `slogan`, `birthday`, `website`, `phone`, `city`, `age`, `degree`, `freelance`, `certification`, `description`, `skills`, `address`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssssssssssssssssss",
        $name,
        $email,
        $pass,
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
        $address
    );

    if ($stmt->execute()) {
        echo '<div class="alert alert-primary alert-dismissible fade show close my-auto" role="alert">
                  Data inserted successfully!
              </div>';
        header("location:index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register-Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form method="post" action="register.php" class="row g-3">
                     <div class="col-12">
                      <label for="yourname" class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" id="yourname" required>
                    </div>
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                     <div class="col-12">
                      <label for="yourtitle" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" id="yourtitle" required>
                    </div>
                      <div class="col-12">
                      <label for="yourplace" class="form-label">place</label>
                      <input type="text" name="place" class="form-control" id="yourplace" required>
                    </div>
                           <div class="col-12">
                      <label for="yourfacebook" class="form-label">facebook</label>
                      <input type="text" name="facebook" class="form-control" id="yourfacebook" required>
                    </div>
                           <div class="col-12">
                      <label for="yourtwitter" class="form-label">twitter</label>
                      <input type="text" name="twitter" class="form-control" id="yourtwitter" required>
                    </div>
                       <div class="col-12">
                      <label for="yourinstagram" class="form-label">instagram</label>
                      <input type="text" name="instagram" class="form-control" id="yourinstagram" required>
                    </div>
                
                       <div class="col-12">
                      <label for="yourlinkdein" class="form-label">linkdein</label>
                      <input type="text" name="linkdein" class="form-control" id="yourlinkden" required>
                    </div>
                       <div class="col-12">
                      <label for="yourgithub" class="form-label">github</label>
                      <input type="text" name="github" class="form-control" id="yourgithub" required>
                    </div>
                       <div class="col-12">
                      <label for="yourslogan" class="form-label">slogan</label>
                      <input type="text" name="slogan" class="form-control" id="yourslogan" required>
                    </div>
                    <div class="col-12">
                      <label for="yourdob" class="form-label">Date Of Birth</label>
                      <input type="text" name="dob" class="form-control" id="yourdob" required>
                    </div>
                    <div class="col-12">
                      <label for="yourweb" class="form-label">website</label>
                      <input type="text" name="website" class="form-control" id="yourweb" >
                    </div>
                       <div class="col-12">
                      <label for="yournumber" class="form-label">phone number</label>
                      <input type="text" name="mobile" class="form-control" id="yournumber" >
                    </div>
                  <div class="col-12">
                      <label for="yourcity" class="form-label">City</label>
                      <input type="text" name="city" class="form-control" id="yourcity" >
                    </div>
                       <div class="col-12">
                      <label for="yourage" class="form-label">age</label>
                      <input type="text" name="age" class="form-control" id="yourage" >
                    </div>
                       <div class="col-12">
                      <label for="yourdegree" class="form-label">degree</label>
                      <input type="text" name="degree" class="form-control" id="yourdegree" >
                    </div>
                       <div class="col-12">
                      <label for="yourfreelance" class="form-label">freelance</label>
                      <input type="text" name="freelance" class="form-control" id="yourfreelance" >
                    </div>
                       <div class="col-12">
                      <label for="yourcertificate" class="form-label">certificate</label>
                      <input type="text" name="certificate" class="form-control" id="yourcertificate" >
                    </div>
                       <div class="col-12">
                      <label for="yourdescription" class="form-label">description</label>
                      <input type="text" name="description" class="form-control" id="yourdescription" >
                    </div>
                       <div class="col-12">
                      <label for="yourskills" class="form-label">skills</label>
                      <input type="text" name="skills" class="form-control" id="yourskills" >
                    </div>
                       <div class="col-12">
                      <label for="youraddress" class="form-label">address</label>
                      <input type="text" name="address" class="form-control" id="youraddress" >
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="caccount" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="#">Dheeraj</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>