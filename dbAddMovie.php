<?php
include("dbConnection.php");

$title=$_POST['txtMTitle'];
$description=$_POST['txtMDescription'];
$releaseDate=$_POST['dtRelease'];
$enddate=$_POST['dtEnd'];
$directorName=$_POST['txtMDirector'];
$trailerLink=$_POST['txtTrailer'];
$country=$_POST['countries'];
$language=$_POST['languages'];

//creating duration value
//Obtaining necessary values for duration
$durationHours=$_POST['hours'];
$durationMinutes=$_POST['minutes'];
$durationSeconds=$_POST['seconds'];
//String concatenation
$duration = sprintf("%02d:%02d:%02d", $durationHours, $durationMinutes, $durationSeconds);

$today= date("Y-m-d");

if ($today<$releaseDate) {
    $sql = "INSERT INTO upcomingmovies (title, description, releaseDate, endDate, duration, country, language, directorName, recentTrailer, posterH, posterV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)";
} else {
    $sql = "INSERT INTO showingmovies (title, description, releaseDate, endDate, duration, country, language, directorName, recentTrailer, posterH, posterV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)";
}


if(isset($_FILES["inHPoster"]) && $_FILES["inHPoster"]["error"] == 0) {
    $imageH = file_get_contents($_FILES["inHPoster"]["tmp_name"]);
} else {
    echo "Please select an image file.";
}

if(isset($_FILES["inVPoster"]) && $_FILES["inVPoster"]["error"] == 0) {
    $imageV = file_get_contents($_FILES["inVPoster"]["tmp_name"]);
} else {
    echo "Please select an image file.";
}

// Using a prepared statement to insert the data
$stmt = mysqli_prepare($conn, $sql);

if($stmt) {
    // Binding the parameters
    mysqli_stmt_bind_param($stmt, "sssssssssss", $title, $description, $releaseDate, $enddate, $duration,$country,$language, $directorName, $trailerLink, $imageH, $imageV );

    // Executing the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "New record added successfully!";
    } else {
        echo "Error executing the statement: " . mysqli_stmt_error($stmt);
    }

    // Closing the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the statement: " . mysqli_error($conn);
}

?>