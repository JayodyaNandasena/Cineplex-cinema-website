<?php
include("dbConnection.php");


$mTitle=$_POST['movie-dropdown'];
$mDate=$_POST['dtShowDate'];
$mTime=$_POST['showTime'];
$mTheatre=$_POST['theatre'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT movieID,releaseDate,endDate FROM showingmovies WHERE title = '$mTitle'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $movieID = $row["movieID"];
            $releaseDate = $row["releaseDate"];
            $endDate = $row["endDate"];	 	
            $sql = "INSERT INTO showing_movie_schedule (movie_id, movie_title, releaseDate, endDate, show_date , show_time, cinema_room) VALUES (?, ?, ?, ?, ?, ?, ?)";    
        }
        }else{
            $sql = "SELECT movieID,releaseDate,endDate FROM upcomingmovies WHERE title = '$mTitle'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    $movieID = $row["movieID"];
                    $releaseDate = $row["releaseDate"];
                    $endDate = $row["endDate"];	 	
                    $sql = "INSERT INTO upcoming_movie_schedule (movie_id, movie_title, releaseDate, endDate, show_date , show_time, cinema_room) VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                }
            }
        }

    }


// Using a prepared statement to insert the data
$stmt = mysqli_prepare($conn, $sql);

if($stmt) {
    // Binding the parameters
    mysqli_stmt_bind_param($stmt, "sssssss", $movieID, $mTitle, $releaseDate, $endDate, $mDate, $mTime, $mTheatre);

    // Executing the statement
    if(mysqli_stmt_execute($stmt)) {
        echo "New record added successfully!";
        header("Location:addSchedule.php");
    } else {
        echo "Error executing the statement: " . mysqli_stmt_error($stmt);
    }

    // Closing the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the statement: " . mysqli_error($conn);
}

?>