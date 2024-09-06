<?php
require "database.php";
include("Layout/header.php"); // Ensure the session is started
?>


<?php
if (isset($_SESSION['username'])) {
    include("Layout/menu.php"); // need menu to show dashboard list else all content in right side...
    // Get the movie ID from query parameters
    if (isset($_GET['edit'])) {
     $edit = $_GET['edit'];
            } else {
                echo "No movie ID specified.";
                exit;
            }
        // Fetch the movie details
        $user_id=$_SESSION['id']; // user id specific
        $query = "SELECT * FROM movie WHERE MovieId = '$edit'" ;
        $final = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($final) > 0) {
            $rows = mysqli_fetch_assoc($final);
            $mid = $rows['MovieId'];
            $mname = $rows['MovieName'];
            $myear = $rows['Year'];
            $mgenre = $rows['Genre'];
            $mrating = $rows['Rating'];
            $mdate = $rows['Date'];
            } else {
                echo "No movie found.";
                exit;
            }

          // Handle form submission
        if (isset($_POST['submit'])) {
              $mid = $_POST['movieid'];
              $mname = $_POST['moviename'];
              $myear = $_POST['year'];
              $mgenre = $_POST['genre'];
              $mrating = $_POST['rating'];
              $mdate = $_POST['date'];
              // movie id fixed cannot change primary key
              $sql = "UPDATE movie SET MovieName = '$mname', Year = '$myear', Genre = '$mgenre', Rating = '$mrating', Date = '$mdate' WHERE MovieId = '$mid'";
          
              if (mysqli_query($conn, $sql)) {
                  echo '<script>location.replace("movie-view.php");</script>';
              } else {
                  echo "Error Detected: " . $conn->error;
              }
          }
 ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Movie Table</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Go Back to Dashboard</a></li>
          <li class="breadcrumb-item"><a href="movie-view.php">Movie</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Movie</h5>
              <button class="btn btn-success"> <a href="movie-view.php" class="text-light"> Go Back </a> </button>
            </div>
          </div>
    </section>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
                        <form method="POST" action="movie-edit.php?edit=<?php echo htmlspecialchars($mid); ?>">
                            <div class="mb-3">
                                <label for="movieid" class="form-label">MovieId</label>
                                <input name="movieid" class="form-control" id="disabledInput" type="text" value="<?php echo htmlspecialchars($mid); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="moviename" class="form-label">MovieName</label>
                                <input name="moviename" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo htmlspecialchars($mname); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input name="year" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo htmlspecialchars($myear); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input name="genre" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo htmlspecialchars($mgenre); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input name="rating" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo htmlspecialchars($mrating); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input name="date" class="form-control" id="disabledInput" type="text" value="<?php echo htmlspecialchars($mdate); ?>">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php
include("Layout/footer.php");
mysqli_close($conn);

} 
else {
  include("Layout/menu.php"); 
  include("unauth-user/Temp-glance.php");
  include("Layout/footer.php");

}
?>
