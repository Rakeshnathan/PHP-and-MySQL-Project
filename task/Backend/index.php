
<?php require "database.php"; 
include("Layout/header.php");
?>
   
<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
  

    $email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
  
    $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($email)){
      echo "Email is empty . Please enter your Email ID to Login";
          }
    elseif(empty($password)){
      echo "Password is empty . Please enter a Password To Login";
          }
    else{      
    
        $login = "SELECT * FROM admin where email = '$email' ";// sql query to get records using email 
        $result = mysqli_query($conn,$login); // to get those records and putting it in an object which is result

        if(mysqli_num_rows ($result) > 0 ) {            // those records might be in set of arrays.....(num_row of result)
            while($row = mysqli_fetch_assoc($result)) //getting all records satisfying the conditions
                   {    
                      if(password_verify($password,$row['Password']))
                      {

                        $_SESSION['id'] = $row['Id'];
                        $_SESSION['username'] = $row['Username'];
                        // echo $row["Id"] . "<br>";
                        // echo $row["Email"] . "<br>";
                        // echo $row["Username"] . "<br>";
                        // echo $row["Time"] . "<br>";
                        header("location:dashboard.php");
                      }
                      else{
                        echo "No Records Found !  <br> Please check your Email and Password and Try Again";
                        }
                   }
        }    
      }
}   
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login </title>
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

.row {

    /* margin-top: calc(-1* var(--bs-gutter-y)); */
    margin-right: calc(-.5* var(--bs-gutter-x)) !important;
    margin-left: calc(-.5* var(--bs-gutter-x))  !important;
}
.container{
  margin-top: 60px !important;
}
a:hover {
    color: #009fd3 !important;
}
</style>

  <main class = "login-style">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div>
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block">LOGIN</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-12">

                <div class="card-body">

                  <div class="pt-4 pb-2 card">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <!--<form class="row g-3 needs-validation" novalidate>-->
                  <form class="row g-3 needs-validation" novalidate method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?> index.php">
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter your Email address.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><span class="bi bi-lock"></span></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your Password!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="Register.php">Create an account</a></p>
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