<?php require "database.php"; 
include("Layout/header.php");
?>
   
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register </title>
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
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<style>
.container{
  margin-top: 50px !important;
}
</style>


  <main class = "login-style">
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div >
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block">REGISTER</span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-12" >
                <div class="card-body">
                  <div class="pt-4 pb-2 card">
                    <h5 class="card-title text-center pb-0 fs-4">Create Your Account</h5>
                    <p class="text-center small">Fill All the Details</p>
                  </div>
                  <!--<form class="row g-3 needs-validation" novalidate>-->
                  <form class="row g-3 needs-validation" novalidate method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?> Register.php">
                    <div class="col-12">
                       <label for="email" class="form-label">Email</label>
                       <div class="input-group has-validation">
                         <span class="input-group-text" id="inputGroupPrepend">@</span>
                         <input type="email" name="email" class="form-control" id="email" required>
                         <div class="invalid-feedback">Please enter your Email Address!</div>
                       </div>
                    </div>
                    
                    <div class="col-12">
                      <label for="email" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><span class="bi bi-person-circle"></span></span>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please enter a Username!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><span class="bi bi-lock"></span></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter a Password!</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button name="submit"class="btn btn-primary w-100" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="index.php">Login here</a></p>
                    </div>
                  </form>
                </div>
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
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // updated with no two same email can be registered 
    // Sanitize and validate input
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    // using javascript to send pop up message 
    $errorMessage = "";
    $successMessage = "";

    if (empty($email)) {
        echo "Email is empty. Please enter your Email ID to Register.";
    } elseif (empty($username)) {
        echo "Username is empty. Please enter a Username to Register.";
    } elseif (empty($password)) {
        echo "Password is empty. Please enter a Password to Register.";
    } else {
        // Check if email already exists
        $sql = "SELECT id FROM admin WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email already exists
            echo "Error: This email address is already registered.";
        } else {
            // Email does not exist, proceed with insertion
            $stmt->close();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin (Email, Username, Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $email, $username, $hash);

            if ($stmt->execute()) {
                echo "You have registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        // Close statement
        $stmt->close();
    }
}

?>
<?php
mysqli_close($conn);
?>
