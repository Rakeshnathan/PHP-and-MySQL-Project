<?php
require "database.php";
include("Layout/header.php"); // Ensure the session is started
?>

<?php
if (isset($_SESSION['username'])) {
    include("Layout/menu.php");
?>
    <main id="main" class="main"><!-- code to put html in php -->
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
                    <h5 class="card-title">Add Movie</h5>
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
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="mb-3">
                                    <label for="movieid" class="form-label">MovieId</label>
                                    <input name="movieid" class="form-control" id="disabledInput" type="text" placeholder="Auto" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="moviename" class="form-label">MovieName</label>
                                    <input name="moviename" type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input name="year" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="genre" class="form-label">Genre</label>
                                    <input name="genre" type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input name="rating" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input name="date" class="form-control" id="disabledInput" type="text" placeholder="Auto" disabled>
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $moviename = filter_input(INPUT_POST, "moviename", FILTER_SANITIZE_SPECIAL_CHARS);
            $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);
            $rating = filter_input(INPUT_POST, "rating", FILTER_SANITIZE_NUMBER_INT);

            if (empty($moviename)) {
                echo "Movie Name is empty. Please enter Movie Name.";
            } elseif (empty($year)) {
                echo "Year is empty. Please enter Movie Year.";
            } elseif (empty($genre)) {
                echo "Genre is empty. Please enter the Movie Genre.";
            } elseif (empty($rating)) {
                echo "Rating field is empty. Please enter a Rating for the Movie.";
            } else {

                $user_id=$_SESSION['id']; //user id specific
                $log = "INSERT INTO movie (MovieName, Year, Genre, Rating,user_id) VALUES ('$moviename', '$year', '$genre', '$rating','$user_id')";
                if (mysqli_query($conn, $log)) {
                    echo "You have submitted successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
        ?>
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
