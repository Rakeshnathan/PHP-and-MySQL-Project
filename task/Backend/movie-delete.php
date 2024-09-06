<?php
require "database.php";
?>

<?php
// Check if the form has been submitted
if (isset($_POST['delete'])) {
    // Sanitize and get the movie ID from the POST data
    $mid = mysqli_real_escape_string($conn, $_POST['movieid']);

    // Prepare the SQL query to delete the movie
    $sql = "DELETE FROM movie WHERE MovieId = '$mid'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect to the content page with a success message
        header("Location: movie-view.php?message=Record+deleted+successfully");
        exit();
    } else {
        // Display error message if the query fails
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No movie ID specified for deletion.";
}
// Close the database connection
mysqli_close($conn);
?>
