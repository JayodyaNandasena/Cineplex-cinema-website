<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Movies</title>
</head>

<body>
    <div class="addMovie">
        <form action="dbAddMovie.php" method="POST" enctype="multipart/form-data">
            <label for="txtMTitle">Title</label>
            <input type="text" name="txtMTitle" id="txtMTitle" placeholder="Movie Title" required>
            <br>

            <label for="txtMDescription">Description</label><br>
            <textarea id="txtMDescription" name="txtMDescription" rows="4" cols="50" required></textarea>
            <br>

            <label for="dtRelease">Release Date</label>
            <input type="date" name="dtRelease" id="dtRelease" required>
            <br>

            <label for="dtEnd">Showing Ending Date</label>
            <input type="date" name="dtEnd" id="dtEnd" required>
            <br>

            <label for="tDuration">Movie Duration</label>
            <div id="tMDuration">
                <input type="number" id="hours" name="hours" min="0" placeholder="Hours" required>
                <input type="number" id="minutes" name="minutes" min="0" max="59" placeholder="Minutes" required>
                <input type="number" id="seconds" name="seconds" min="0" max="59" placeholder="Seconds" required>

            </div>
            <br>

            <label for="countries">Country</label>
            <select name="countries" id="countries"></select><br><br><br>

            <label for="languages">Language</label>
            <select name="languages" id="languages">
                <option value="English">English</option>
                <option value="Sinhala">Sinhala</option>
                <option value="Tamil">Tamil</option>
                <option value="Korean">Korean</option>
            </select><br><br><br>

            <label for="txtMDirector">Director</label>
            <input type="text" name="txtMDirector" id="txtMDirector" placeholder="Director's Name" required>
            <br>

            <label for="">Horizontal Movie Poster</label>
            <input type="file" name="inHPoster" id="inHPoster" accept="image/*">
            <br>

            <label for="">Vertical Movie Poster</label>
            <input type="file" name="inVPoster" id="inVPoster" accept="image/*">
            <br>

            <label for="">Recent Movie trailer Link</label>
            <textarea name="txtTrailer" id="txtTrailer" cols="30" rows="10" required></textarea>
            <br><br><br>

            <button type="submit">Add Movie</button>



        </form>
    </div>

    <script src="Assets/countries.js"></script>
</body>

</html>