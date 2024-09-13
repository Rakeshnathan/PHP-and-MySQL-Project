<?php
require "database.php";
include("Layout/header.php"); // Ensure the session is started

if (isset($_SESSION['username'])) {
  include("Layout/menu.php"); // Menu for navigation
  ?>

  <main id="main" class="main"> <!-- Main content area -->

    <div class="pagetitle">
      <h1>Admin Movie Overview</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Go Back to Dashboard</a></li>
          <li class="breadcrumb-item active">Admin View</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <!-- Admin Dashboard Overview -->
          <div class="card">
            <div class="card-body">
              <center>
                <h5 class="card-title"><i class="bi bi-info-circle"></i> Admin Movie Overview</h5>
                <p class="card-title">Manage and view all users' movie data below.</p>
              </center>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Total Movies Count -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card info-card sales-card mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-film"></i> Total Movies <span>| Count</span></h5>
              <div class="d-flex align-items-center">
                <div class="ps-3">
                  <?php
                  if ($_SESSION['username'] == "mainadmin") {
                    $total_movies_query = "SELECT COUNT(*) AS total FROM movie";
                    $total_movies_result = mysqli_query($conn, $total_movies_query);
                    if ($total_movies_result) {
                      $total_movies_row = mysqli_fetch_assoc($total_movies_result);
                      $total_movies = $total_movies_row['total'];
                      echo '<h6>' . htmlspecialchars($total_movies) . '</h6>';
                    } else {
                      echo '<h6>Unable to fetch data.</h6>';
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Movies by Genre -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card info-card revenue-card mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-tags"></i> Movies by Genre <span>| Count</span></h5>
              <?php
              if ($_SESSION['username'] == "mainadmin") {
                $genres_query = "SELECT Genre, COUNT(*) AS count FROM movie GROUP BY Genre";
                $genres_result = mysqli_query($conn, $genres_query);
                if ($genres_result) {
                  while ($row = mysqli_fetch_assoc($genres_result)) {
                    echo '<div class="d-flex align-items-center">';
                    echo '<div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">';
                    echo '<i class="bi bi-dot"></i>';
                    echo '</div>';
                    echo '<div class="ps-3">';
                    echo '<h6>' . htmlspecialchars($row['Genre']) . ': ' . htmlspecialchars($row['count']) . '</h6>';
                    echo '</div>';
                    echo '</div>';
                  }
                } else {
                  echo '<p>No genre data found.</p>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Top Rated Movies -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card info-card rating-card mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-star"></i> Top Rated Movies</h5>
              <?php
              if ($_SESSION['username'] == "mainadmin") {
                $top_rated_query = "SELECT MovieName, Rating FROM movie ORDER BY Rating DESC LIMIT 5";
                $top_rated_result = mysqli_query($conn, $top_rated_query);
                if ($top_rated_result) {
                  while ($row = mysqli_fetch_assoc($top_rated_result)) {
                    echo '<div class="d-flex align-items-center">';
                    echo '<div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">';
                    echo '<i class="bi bi-dot"></i>';
                    echo '</div>';
                    echo '<div class="ps-3">';
                    echo '<h6>' . htmlspecialchars($row['MovieName']) . ': ' . htmlspecialchars($row['Rating']) . '</h6>';
                    echo '</div>';
                    echo '</div>';
                  }
                } else {
                  echo '<p>No top-rated movies found.</p>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Recent Movies -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card info-card recent-card mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-clock"></i> Recent Movies</h5>
              <?php
              if ($_SESSION['username'] == "mainadmin") {
                $recent_movies_query = "SELECT MovieName, Date FROM movie ORDER BY Date DESC LIMIT 5";
                $recent_movies_result = mysqli_query($conn, $recent_movies_query);
                if ($recent_movies_result) {
                  while ($row = mysqli_fetch_assoc($recent_movies_result)) {
                    echo '<div class="d-flex align-items-center">';
                    echo '<div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">';
                    echo '<i class="bi bi-dot"></i>';
                    echo '</div>';
                    echo '<div class="ps-3">';
                    echo '<h6>' . htmlspecialchars($row['MovieName']) . ' (Added on: ' . htmlspecialchars($row['Date']) . ')</h6>';
                    echo '</div>';
                    echo '</div>';
                  }
                } else {
                  echo '<p>No recent movies found.</p>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Existing Movie Table -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-table"></i> Movie Table</h5>
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
                  // Display all movies for the admin
                  if ($_SESSION['username'] == "mainadmin") {
                    $query = "SELECT * FROM movie"; // SQL query to get records
                    $final = mysqli_query($conn, $query); // Get those records
                    if (mysqli_num_rows($final) > 0) {
                      while ($rows = mysqli_fetch_assoc($final)) {
                        $mid = $rows['MovieId'];  // Movie ID
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
                            <button class="btn btn-success" style="float: left;">
                              <a href='movie-edit.php?edit=<?php echo urlencode($mid); ?>' class="text-light"> <i class="bi bi-pencil"></i> Edit </a>
                            </button> &nbsp;
                            <form method="POST" action="movie-delete.php" style="display:inline;">
                              <input type="hidden" name="movieid" value="<?php echo htmlspecialchars($mid); ?>">
                              <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?');">
                                <i class="bi bi-trash"></i> Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php       
                      }
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

} else {
  include("Layout/menu.php");
  include("unauth-user/Temp-glance.php");
  include("Layout/footer.php");
}
?>
