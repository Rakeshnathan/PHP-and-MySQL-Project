<?php
require "database.php";
include("Layout/header.php"); // Ensure the session is started
?>

<?php
if (isset($_SESSION['username'])) {
  include("Layout/menu.php"); // need menu to show dashboard list else all content in right side...
  
?>
  <main id="main" class="main"> <!-- code to put html in php -->

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
              <center>
              <h5 class="card-title">Organize your own Movie List</h5>
              <h1>Welcome to your Movie Library</h1>
              <p class="card-title">Enter the movies you've watched and see your list below.</p>
              </center>
            </div>
          </div>
    </section>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <!-- two boxes page and search -->
            
           
           
            <button class="btn btn-success"> <a href="movie-add.php" class="text-light"> Add </a> </button>
            <button class="btn btn-success"> <a href="dashboard.php" class="text-light"> Go Back </a> </button>
            <br>
            <!-- Table with stripped rows -->
            <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Movie Id</th>
                    <th scope="col">Movie Name</th>
                    <th scope="col">Year</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $user_id=$_SESSION['id'];
                  $query = "SELECT * FROM movie where user_id='".$user_id."'"; // SQL query to get records
                  $final = mysqli_query($conn, $query); // Get those records and put them in an object which is result
                    if (mysqli_num_rows($final) > 0) { // Check if there are any records
                        while ($rows = mysqli_fetch_assoc($final)) { // Get all records satisfying the conditions
                           $mid = $rows['MovieId'];  // Movie ID used in updating/deleting records
                           $mname = $rows['MovieName'];
                           $myear = $rows['Year'];
                           $mgenre = $rows['Genre'];
                           $mrating = $rows['Rating'];
                           $mdate = $rows['Date'];
                           ?>
                           <tr>
                           <td><?php echo htmlspecialchars($mid); ?></td>
                           <td><?php echo htmlspecialchars($mname); ?></td>
                           <td><?php echo htmlspecialchars($myear); ?></td>
                           <td><?php echo htmlspecialchars($mgenre); ?></td>
                           <td><?php echo htmlspecialchars($mrating); ?></td>
                           <td><?php echo htmlspecialchars($mdate); ?></td>
                           <td>
                           <button class="btn btn-success" style="float: left;"><a href='movie-edit.php?edit=<?php echo urlencode($mid); ?>' class="text-light"> Edit </a> </button> &nbsp;
                           <form method="POST" action="movie-delete.php" style="display:inline;">
                            <input type="hidden" name="movieid" value="<?php echo htmlspecialchars($mid); ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</button>
                           </form>
                            </td>
                            </tr>
                    <?php       
                        }
                    }
                 ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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

  


