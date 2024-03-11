<?php
include("dbConnection.php");

session_start();

// Flag to determine if booked seats were fetched (initially false)
$bookedSeatsFetched = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['b_show_date']) && isset($_POST['b_show_time']) && isset($_POST['b_cinema_room'])) {
    // Fetch booked seats based on form submission
    $show_date = $_POST['b_show_date'];
    $show_time = $_POST['b_show_time'];
    $cinema_room = $_POST['b_cinema_room'];

    $sql = "SELECT seat_no FROM seat_reservation WHERE showDate='$show_date' AND showTime='$show_time' AND cinema_room='$cinema_room'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $booked_seats = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $booked_seats[] = (int)$row['seat_no'];
      }
      mysqli_free_result($result);

        $_SESSION['booked_seats'] = $booked_seats; // Store booked seats
        $_SESSION['show_date'] = $show_date;
        $_SESSION['show_time'] = $show_time;
        $_SESSION['cinema_room'] = $cinema_room;
      $bookedSeatsFetched = true; // Set flag to indicate successful retrieval
      header("Location: chooseSeat.php");
    } else {
      echo "Error executing the statement: " . mysqli_error($conn);
    }
  } else {
    // Handle potential errors if required data is missing in the POST request
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $cinema_room = $_POST['cinema_room'];
  
    $selectedSeatCount = (int)$_POST['selectedSeatCount'];
    $selectedSeatsIndex = json_decode($_POST['selectedSeatsIndex']);
  
    $stmt = $conn->prepare("INSERT INTO seat_reservation (seat_no,cinema_room,showDate,showTime) VALUES (?, ?, ?, ?)");
  
    for ($i = 0; $i < $selectedSeatCount; $i++) {
      $selectedSeat = $selectedSeatsIndex[$i];
  
      $stmt->bind_param("ssss", $selectedSeat, $cinema_room, $show_date, $show_time);
      $stmt->execute();
  
      if ($stmt->error) {
        echo "Error inserting seat " . ($i + 1) . ": " . $stmt->error; // Informative message
      } else {
        echo "Seat " . ($i + 1) . " added successfully!"; // Or a more informative message
      }
    }
  
    $stmt->close();
  }

    // $selectedSeatCount = (int)$_POST['selectedSeatCount'];
    // $selectedSeatsIndex = json_decode($_POST['selectedSeatsIndex']);

    // for ($i = 0; $i < $selectedSeatCount; $i++) {
    //   $selectedSeat = $selectedSeatsIndex[$i];

    //   $sql = "INSERT INTO seat_reservation (seat_no,cinema_room,showDate,showTime) VALUES ($selectedSeat,'$cinema_room','$show_date','$show_time')";
    //   $result = mysqli_query($conn, $sql);

    //   if ($result) {
    //     echo "Seat " . ($i + 1) . " added successfully!";
    //   } else {
    //     echo "Error inserting seat " . ($i + 1) . "!"; // Generic error message
    //   }
    // }

}

