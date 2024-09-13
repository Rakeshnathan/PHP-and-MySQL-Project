<?php
require "database.php";
include("Layout/header.php"); // Ensure the session is started

if (isset($_SESSION['username'])) {
    include("Layout/menu.php");  // Include menu for navigation
    // Get user ID from session
    $user_id = $_SESSION['id'];

    // Query to count total movies
    $total_movies_query = "SELECT COUNT(*) AS total FROM movie WHERE user_id = '$user_id'";
    $total_movies_result = mysqli_query($conn, $total_movies_query);
    if ($total_movies_result) {
        $total_movies_row = mysqli_fetch_assoc($total_movies_result);
        $total_movies = $total_movies_row['total'];
    } else {
        $total_movies = 0;
    }

    // Query to count movies by genre
    $genres_query = "SELECT Genre, COUNT(*) AS count FROM movie WHERE user_id = '$user_id' GROUP BY Genre";
    $genres_result = mysqli_query($conn, $genres_query);
    $genres_count = [];
    if ($genres_result) {
        while ($row = mysqli_fetch_assoc($genres_result)) {
            $genres_count[$row['Genre']] = $row['count'];
        }
    }

    // Query to get top-rated movies
    $top_rated_query = "SELECT MovieName, Rating FROM movie WHERE user_id = '$user_id' ORDER BY Rating DESC LIMIT 5";
    $top_rated_result = mysqli_query($conn, $top_rated_query);

    // Query to get recent movies
    $recent_movies_query = "SELECT MovieName, Date FROM movie WHERE user_id = '$user_id' ORDER BY Date DESC LIMIT 5";
    $recent_movies_result = mysqli_query($conn, $recent_movies_query);

    // Query to get average rating
    $average_rating_query = "SELECT AVG(Rating) AS avg_rating FROM movie WHERE user_id = '$user_id'";
    $average_rating_result = mysqli_query($conn, $average_rating_query);
    $average_rating = $average_rating_result ? mysqli_fetch_assoc($average_rating_result)['avg_rating'] : 0;

    // Query to get movies by year
    $movies_by_year_query = "SELECT Year, COUNT(*) AS count FROM movie WHERE user_id = '$user_id' GROUP BY Year ORDER BY Year DESC";
    $movies_by_year_result = mysqli_query($conn, $movies_by_year_query);
?>
<main id="main" class="main"> <!-- Main content area -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Full-width columns for vertical stacking -->
            <div class="col-lg-12">

                <!-- Total Movies Card -->
                <div class="card info-card sales-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-film"></i> Movies <span>| Count</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h6><?php echo htmlspecialchars($total_movies); ?></h6>
                            </div>
                        </div>
                    </div>
                </div><!-- End Total Movies Card -->

                <!-- Genres Count Card -->
                <div class="card info-card revenue-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Today</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-tag"></i> Genres <span>| Count</span></h5>
                            <div class="ps-3">
                                <?php foreach ($genres_count as $genre => $count): ?>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-dot"></i> <!-- Dot icon for records -->
                                        <h6 class="ms-2"><?php echo htmlspecialchars($genre); ?>: <?php echo htmlspecialchars($count); ?></h6>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End Genres Count Card -->

                <!-- Top Rated Movies Card -->
                <div class="card info-card rating-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Top Rated</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-star"></i> Top Rated Movies</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <?php
                                if ($top_rated_result) {
                                    while ($row = mysqli_fetch_assoc($top_rated_result)) {
                                        echo '<div class="d-flex align-items-center">';
                                        echo '<i class="bi bi-dot"></i>'; // Dot icon for records
                                        echo '<h6 class="ms-2">' . htmlspecialchars($row['MovieName']) . ': ' . htmlspecialchars($row['Rating']) . '</h6>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p>No top-rated movies found.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End Top Rated Movies Card -->

                <!-- Recent Movies Card -->
                <div class="card info-card recent-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Recent</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-calendar"></i> Recent Movies</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <?php
                                if ($recent_movies_result) {
                                    while ($row = mysqli_fetch_assoc($recent_movies_result)) {
                                        echo '<div class="d-flex align-items-center">';
                                        echo '<i class="bi bi-dot"></i>'; // Dot icon for records
                                        echo '<h6 class="ms-2">' . htmlspecialchars($row['MovieName']) . ' (Added on: ' . htmlspecialchars($row['Date']) . ')</h6>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p>No recent movies found.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End Recent Movies Card -->

               <!-- Average Rating Card -->
               <div class="card info-card average-rating-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-bar-chart"></i> Average Rating</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <?php
                                $average_rating_query = "SELECT AVG(Rating) AS avg_rating FROM movie WHERE user_id = '$user_id'";
                                $average_rating_result = mysqli_query($conn, $average_rating_query);
                                if ($average_rating_result) {
                                    $average_rating_row = mysqli_fetch_assoc($average_rating_result);
                                    $average_rating = $average_rating_row['avg_rating'];
                                    echo '<h6>' . number_format($average_rating, 2) . '</h6>';
                                } else {
                                    echo '<p>Unable to calculate average rating.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End Average Rating Card -->

                <!-- Movies by Year Card -->
                <div class="card info-card year-card mb-4">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">All Time</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-calendar-range"></i> Movies by Year</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <?php
                                if ($movies_by_year_result) {
                                    while ($row = mysqli_fetch_assoc($movies_by_year_result)) {
                                        echo '<div class="d-flex align-items-center">';
                                        echo '<i class="bi bi-dot"></i>'; // Dot icon for records
                                        echo '<h6 class="ms-2">' . htmlspecialchars($row['Year']) . ': ' . htmlspecialchars($row['count']) . '</h6>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p>No data available.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End Movies by Year Card -->

            </div><!-- End Full-width columns -->
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
