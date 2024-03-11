<?php
include("dbConnection.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if (strpos($username, "4dm!N") === 0) {
        $adminLogged=true;
    } else{
        $adminLogged=false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/style.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Cineplex Movie Theatre</title>
</head>

<body>
<nav>
        <img src="Assets/images/logo2.png" alt="Cineplex" id="logo">
        <ul>
            <li><a href="index.php">Home</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($adminLogged): ?>
                    <li><a href="manageMovie.php">Manage Movies</a></li>
                    <li><a href="addSchedule.php">Add Shedules</a></li>
                    <li><a href="viewBookings.php">View Bookings</a></li>
                    <li><a href="signOut.php" target="_blank">Customer View</a></li>
                    <li><a href="createAccounts.php">Create Accounts</a></li>
                <?php else: ?>
                    <li><a href="showing.html">Now Showing</a></li>
                    <li><a href="viewSchedule.php">View Schedule</a></li>
                    <li><a href="chooseMovie.php">Buy Tickets</a></li>
                    <li><a href="showing.html">Contact</a></li>
                <?php endif; ?>
                <li><a href="signOut.php">Sign Out</a></li>
            <?php else: ?>
            <li><a href="showing.html">Now Showing</a></li>
            <li><a href="viewSchedule.php">View Schedule</a></li>
            <li><a href="chooseMovie.php">Buy Tickets</a></li>
            <li><a href="showing.html">Contact</a></li>
            <li><a href="SignIn.php">Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="slideshow-container">
    <?php

        $sqls = "SELECT title,description,duration, posterH,recentTrailer FROM showingmovies ORDER BY releaseDate DESC LIMIT 3";
        $results = $conn->query($sqls);

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $title = $row["title"];
                $storyline = $row["description"];
                $duration = $row["duration"];
                $trailer = $row["recentTrailer"];

                // Encode image data to base64 for inline use
                $encoded_image = base64_encode($row["posterH"]);
                $image_source = "data:image/jpeg;base64," . $encoded_image; // Assuming JPEG image

                echo "<div class='mySlides fade'>
                        <img src='$image_source' style='width:100%'>
                        <div class='details'>
                            <div class='text'>$title</div><br>
                            <div class='text'>$storyline</div><br>
                            <div class='text'>$duration</div><br>
                            <div id='trailer-embed'>$trailer</div>
                            <input type='button' value='Watch trailer' id='btnWatchTrailer'>
                            <input type='button' value='Buy Tickets' id='btnBuyTickets'><br>
                            <div id='trailer-embed' style='display: none;'></div>  </div>
                            </div>
                    </div>";
                
            }
        } else {
        echo "No now showing movies found";
        }

        $x=0;
        while($x<3){
            echo "<span class='dot'></span>";
            $x++;
        }
        
        $sqlu = "SELECT title,description,duration, posterH,recentTrailer FROM upcomingmovies ORDER BY releaseDate DESC LIMIT 3";
        $resultu = $conn->query($sqlu);

        if ($resultu->num_rows > 0) {
            while ($row = $resultu->fetch_assoc()) {
                $title = $row["title"];
                $storyline = $row["description"];
                $duration = $row["duration"];
                $trailer = $row["recentTrailer"];

                // Encode image data to base64 for inline use
                $encoded_image = base64_encode($row["posterH"]);
                $image_source = "data:image/jpeg;base64," . $encoded_image; // Assuming JPEG image

                echo "<div class='mySlides fade'>
                        <img src='$image_source' style='width:100%'>
                        <div class='details'>
                            <div class='text'>$title</div><br>
                            <div class='text'>$storyline</div><br>
                            <div class='text'>$duration</div><br>
                            <div id='trailer-embed'>$trailer</div>
                            <input type='button' value='Watch trailer' id='btnWatchTrailer'>
                            <input type='button' value='Buy Tickets' id='btnBuyTickets'><br>
                            <div id='trailer-embed' style='display: none;'></div>  </div>
                            </div>
                    </div>";
            }
        } else {
        echo "No upcoming movies found";
        }

        $y=0;
        while($y<3){
            echo "<span class='dot'></span>";
            $y++;
        }
    ?>
    </div>

    <div>
        <h1>Now Showing</h1>

        <?php
        $sql = "SELECT title, duration, posterV FROM showingmovies ORDER BY releaseDate";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count=0;
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $duration = $row["duration"];

                // Encode image data to base64 for inline use
                $encoded_image = base64_encode($row["posterV"]);
                $image_source = "data:image/jpeg;base64," . $encoded_image; // Assuming JPEG image

                echo 
                    "<div class='card' style='width: 18rem;'>
                        <img src='$image_source' class='card-img-top' alt='$title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <h5 class='card-title'>$duration</h5>
                            <a href='#' class='btn btn-primary'>Watch Trailer</a>
                            <a href='#' class='btn btn-primary'>Buy Tickets</a>
                        </div>
                    </div>";
                    
            }
        } else {
        echo "No upcoming movies found";
        }
    ?>

    </div>
    <hr>
    <div>
        <h1>Upcoming Movies</h1>

        <?php
        $sql = "SELECT title, duration, posterV FROM upcomingmovies ORDER BY releaseDate";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $count=0;
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $duration = $row["duration"];

                // Encode image data to base64 for inline use
                $encoded_image = base64_encode($row["posterV"]);
                $image_source = "data:image/jpeg;base64," . $encoded_image; // Assuming JPEG image

                echo 
                    "<div class='card' style='width: 18rem;'>
                        <img src='$image_source' class='card-img-top' alt='$title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <h5 class='card-title'>$duration</h5>
                            <a href='#' class='btn btn-primary'>Watch Trailer</a>
                            <a href='#' class='btn btn-primary'>Buy Tickets</a>
                        </div>
                    </div>";
                    
            }
        } else {
        echo "No upcoming movies found";
        }
    ?>

        

    </div>





    
    <script src="Assets/script.js"></script>
</body>

</html>