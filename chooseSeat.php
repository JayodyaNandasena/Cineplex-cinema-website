<?php
include("dbConnection.php");
session_start();

// Check for user login
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $adminLogged = (strpos($username, "4dm!N") === 0);
} else {
  $adminLogged = false; // Assume not admin if username is not set
}

// Check for movie selection
if (isset($_SESSION['show_date'])) {
  $movie_selected = true;
  $show_date=$_SESSION['show_date'];
  $show_time=$_SESSION['show_time'];
  $cinema_room =$_SESSION['cinema_room'];

  if (!empty($_SESSION['booked_seats'])) {
    $booked_seats = $_SESSION['booked_seats'];
  } else {
    $booked_seats = null;
  }
} else {
  $movie_selected = false;
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


    <?php
    if ($movie_selected) {
    ?>

<form action="dbBuyTickets.php" method="post">
  <?php
  echo "
  <input type='text' name='show_date' id='show_date' value='$show_date' style='display: none;'>
  <input type='text' name='show_time' id='show_time' value='$show_time' style='display: none;'>
  <input type='text' name='cinema_room' id='cinema_room' value='$cinema_room' style='display: none;'>
  ";
    ?>

        

    <div class="container" style="display: block;"> 
    <div class="screen"></div>
    <h5>SCREEN</h5>

    <?php for ($i = 0; $i < 10; $i++) { ?>
        <div class="row">
            <?php for ($j = 0; $j < 25; $j++) {
            $seatClass = "seat"; // Default class
            ?>
            <div class="<?php echo $seatClass; ?>" data-seat-no="<?php echo $i * 25 + $j; ?>"></div>
            <?php } ?>
        </div>
    <?php } ?>

    <ul class="showcase" style="display: block;"> <li>
        <div class="seat"></div>
        <small>Available</small>
        </li>

        <li>
        <div class="seat selected"></div>
        <small>Selected by you</small>
        </li>

        <li>
        <div class="seat occupied"></div>
        <small>Booked</small>
        </li>
    </ul>

    <p class="text" style="display: block;"> You have selected <span id="count">0</span> seats for a price of Rs. <span id="total">0</span>
    </p>
        <input type="hidden" name="selectedSeatCount" id="selectedSeatCountInput">
        <input type="hidden" name="selectedSeatsIndex" id="selectedSeatsIndexInput">
        <button type="submit">Book Seats</button>
    </form>
    </div>

    <?php
    } 
    ?>


    <script src="Assets/booking.js"></script>
  </body>
</html>