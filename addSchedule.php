<?php
include("dbConnection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedules</title>
</head>

<body>
    <div class="addSchedule">
        <form action="dbAddSchedule.php" method="POST" enctype="multipart/form-data">
            <label for="">Select a Movie</label>
            <select name="movie-dropdown" id="movie-dropdown">
                <option value="">Select Movie</option>
                <?php
                    $sqls = "SELECT title FROM showingmovies";
                    $results = $conn->query($sqls);

                    if ($results->num_rows > 0) {
                        while ($row = $results->fetch_assoc()) {
                        $title = $row["title"];
                        echo "<option value='$title'>$title</option>";
                        }
                    } else {
                        echo "<option>No now showing movies found</option>";
                    }

                    $sqlu = "SELECT title FROM upcomingmovies";
                    $resultu = $conn->query($sqlu);

                    if ($resultu->num_rows > 0) {
                        while ($row = $resultu->fetch_assoc()) {
                        $title = $row["title"];
                        echo "<option value='$title'>$title</option>";
                        }
                    } else {
                        echo "<option>No now showing movies found</option>";
                    }
                ?>
            </select>
            <br>

            <div id="scheduling">
                <label for="dtShowDate">Add Date</label>
                <input type="date" name="dtShowDate" id="dtShowDate" required> <br>

                <label for="showTime">Add Time</label>
                <select name="showTime" id="showTime"> 
                <option value="9:00 AM">9:00 AM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="9:00 PM">9:00 PM</option>
                </select><br><br><br>

                <label for="theatre">Select Theatre</label>
                <select name="theatre" id="theatre"> <option value="R1">R1</option>
                <option value="R2">R2</option>
                </select><br><br><br>
            </div>

            <!-- //<button id="addScheduleButton">Add Another Schedule</button> -->

            <button type="submit">Submit</button>
            </form>

    </div>

    <script src="Assets/script.js"></script>
</body>

</html>