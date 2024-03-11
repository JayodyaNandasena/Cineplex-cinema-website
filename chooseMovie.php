<?php
include("dbConnection.php");
session_start();

// Check for user login
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $adminLogged = (strpos($username, "4dm!N") === 0);
} else {
  header("Location: signIn.php");
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/booking.css" />
    <!-- <link rel="stylesheet" href="Assets/style.css"> -->
    
    <title>Movie Seat Booking</title>
  </head>

  <body>
    <nav>
        <img src="Assets/images/logo2.png" alt="Cineplex" id="logo">
        <ul>
            <li><a href="index.php">Home</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($adminLogged): ?>
                    <li><a href="manageMovie.php">Manage Movies</a></li>
                    <li><a href="viewBookings.php">View Bookings</a></li>
                    <li><a href="viewBookings.php">Customer View</a></li>
                    <li><a href="createAccounts.html">Create Accounts</a></li>
                <?php else: ?>
                    <li><a href="showing.html">Now Showing</a></li>
                    <li><a href="showing.html">Upcoming</a></li>
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

    <div class="movie-container">
      <label>Pick a movie:</label>

      <form action="dbBuyTickets.php" method="POST" id="pickMovieForm">
      <?php
        $sql = "SELECT title, duration, posterV FROM showingmovies ORDER BY releaseDate";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
          $title = $row["title"];
          $duration = $row["duration"];
          $encoded_image = base64_encode($row["posterV"]);
          $image_source = "data:image/jpeg;base64," . $encoded_image;

          echo "<div class='scheduleDiv'>
                <table style='border: 1px solid #ddd; border-collapse: collapse;'>
                    <tr>
                      <th rowspan='2'>
                        <button type='submit'>
                          <img src='$image_source' class='card-img-top' alt='$title' onclick='selectMovie(\"$title\")'>
                        </button>
                      </th>
                      <th>$title<br>$duration</th>
                    </tr>";

          // Get schedule data for the current movie
          $sqlS = "SELECT show_date, show_time, cinema_room FROM showing_movie_schedule WHERE movie_title='$title'";
          $resultS = $conn->query($sqlS);

          if ($resultS->num_rows > 0) {
            // Displaying data in a single row
            echo "<tr><td>";
            while ($rowS = $resultS->fetch_assoc()) {
              $show_date = $rowS["show_date"];
              $show_time = $rowS["show_time"];
              $cinema_room = $rowS["cinema_room"];
              echo "<input type='hidden' name=b_show_date value=''>
                    <input type='hidden' name='b_show_time' value=''>
                    <input type='hidden' name='b_cinema_room' value=''>";

              // Create a button for each schedule
              echo "<button type='submit'>$show_date<br>$show_time</button>";
            }
          } else {
            echo "No Schedules found";
          }

            echo "</td>
                    </tr>";
            echo "</table>
                </div>";
          }
         } else {
            echo "No Now Showing movies found";
          }
      ?>


      </form>
    </div>


    <!-- <script src="Assets/booking.js"></script> -->
    <script>
        function selectMovie(movieTitle) {
          document.getElementById("pickMovieForm").selectedMovie.value = movieTitle;
        }
      </script>
  </body>
</html>