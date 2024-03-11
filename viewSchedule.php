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
    <title>Movie Schedule</title>
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
                    <li><a href="buyTickets.php">Buy Tickets</a></li>
                    <li><a href="showing.html">Contact</a></li>
                <?php endif; ?>
                <li><a href="signOut.php">Sign Out</a></li>
            <?php else: ?>
            <li><a href="showing.html">Now Showing</a></li>
            <li><a href="showing.html">Upcoming</a></li>
            <li><a href="buyTickets.php">Buy Tickets</a></li>
            <li><a href="showing.html">Contact</a></li>
            <li><a href="SignIn.php">Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<div>
    
    <h1>Now Showing</h1>

    <?php
        $sql = "SELECT title, duration, posterV FROM showingmovies ORDER BY releaseDate";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $duration = $row["duration"];

            // Encode image data to base64 for inline use
            $encoded_image = base64_encode($row["posterV"]);
            $image_source = "data:image/jpeg;base64," . $encoded_image;

            echo "<div class='scheduleDiv'>
                    <table style='border: 1px solid #ddd; border-collapse: collapse;'>
                    <tr>
                        <th rowspan='4'>
                        <img src='$image_source' class='card-img-top' alt='$title'>
                        </th>
                        <th>$title<br>$duration</th>
                    </tr>";

            // Get schedule data for the current movie
            $sqlS = "SELECT show_date, show_time, cinema_room FROM showing_movie_schedule WHERE movie_title='$title'";
            $resultS = $conn->query($sqlS);

            if ($resultS->num_rows > 0) {
            // Storing data in separate arrays to display
            $show_dates = [];
            $cinema_rooms = [];
            $show_times = [];

            while ($rowS = $resultS->fetch_assoc()) {
                $show_dates[] = $rowS["show_date"];
                $cinema_rooms[] = $rowS["cinema_room"];
                $show_times[] = $rowS["show_time"];
            }

            // Displaying data in separate rows
            echo "<tr>";
            foreach ($show_dates as $date) {
                echo "<td>$date</td>";
            }
            echo "</tr>";

            echo "<tr>";
            foreach ($cinema_rooms as $room) {
                echo "<td>$room</td>";
            }
            echo "</tr>";

            echo "<tr>";
            foreach ($show_times as $time) {
                echo "<td>$time</td>";
            }
            echo "</tr>";
            } else {
            echo "<tr><td colspan='3'>No Schedules found</td></tr>";
            }

            echo "</table>
                </div>";
        }
        } else {
        echo "No Now Showing movies found";
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
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $duration = $row["duration"];

            // Encode image data to base64 for inline use
            $encoded_image = base64_encode($row["posterV"]);
            $image_source = "data:image/jpeg;base64," . $encoded_image;

            echo "<div class='scheduleDiv'>
                    <table style='border: 1px solid #ddd; border-collapse: collapse;'>
                    <tr>
                        <th rowspan='4'>
                        <img src='$image_source' class='card-img-top' alt='$title'>
                        </th>
                        <th>$title<br>$duration</th>
                    </tr>";

            // Get schedule data for the current movie
            $sqlS = "SELECT show_date, show_time, cinema_room FROM upcoming_movie_schedule WHERE movie_title='$title'";
            $resultS = $conn->query($sqlS);

            if ($resultS->num_rows > 0) {
            // Storing data in separate arrays to display
            $show_dates = [];
            $cinema_rooms = [];
            $show_times = [];

            while ($rowS = $resultS->fetch_assoc()) {
                $show_dates[] = $rowS["show_date"];
                $cinema_rooms[] = $rowS["cinema_room"];
                $show_times[] = $rowS["show_time"];
            }

            // Displaying data in separate rows
            echo "<tr>";
            foreach ($show_dates as $date) {
                echo "<td>$date</td>";
            }
            echo "</tr>";

            echo "<tr>";
            foreach ($cinema_rooms as $room) {
                echo "<td>$room</td>";
            }
            echo "</tr>";

            echo "<tr>";
            foreach ($show_times as $time) {
                echo "<td>$time</td>";
            }
            echo "</tr>";
            } else {
            echo "<tr><td colspan='3'>No Schedules found</td></tr>";
            }

            echo "</table>
                </div>";
        }
        } else {
        echo "No Upcoming movies found";
        }
        ?>
</div>
</body>
</html>