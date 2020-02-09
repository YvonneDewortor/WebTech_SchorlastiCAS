<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/submit_admin_forms.js"></script>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../../css/admin_forms.css"></link>
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Add a New Movie Showtime</title>
</head>
<body>

    <div class="back">
        <button class="arrow left" onclick="window.location.href = '../';">
            <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" points="
            45.63,75.8 0.375,38.087 45.63,0.375 "/>
            </svg>  
        </button>
    </div>

    <div class="container">
        <h2>New Movie Showtime</h2>
        <h1>Add a new movie showtime!</h1>
    
        <form action="" method="POST" id="add_showtime_form">
            <div class="fields">
                <input type="hidden" name="showtime_post" id="showtime_post" value="empty" />
                <span>
                    <select name="showtime_movie" id="showtime_movie" required>
                        <option value="" selected="selected">Select a Movie</option>
                        <?php
                            require_once("../../db/movie.php");
                            // Generate all cinemas
                            // Make <option> text the cinema_name, and cinema_id the the value
                            $movie = new Movie();
                            $result = $movie->all_movies();
                            
                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['Movie_ID'].'">'.$row['Movie_Title'].'</option>';
                                }

                            }
                        ?>
                    </select>
                </span>
                <br />
                <span>
                    <input name="showtime" id="showtime" placeholder="Showtime" type="time" required />
                </span>
                <br />
                <span>
                    <input name="showdate_start" id="showdate_start" placeholder="Showdate Start" type="date" required />
                </span>
                <br />
                <span>
                    <input name="showdate_end" id="showdate_end" placeholder="Showdate End" type="date" required />
                </span>
                <br />
                <span>
                    <select name="showtime_theatre" id="showtime_theatre" required>
                        <option value="" selected="selected">Select a theatre</option>
                        <?php
                            require_once("../../db/theatre.php");
                            // Generate all cinemas
                            // Make <option> text the cinema_name, and cinema_id the the value
                            $theatre = new Theatre();
                            $result = $theatre->all_theatre();
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['Theatre_ID'].'">'.$row['Theatre_Name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </span>
            </div>
            <div class="submit">
                <input class="submit" value="Submit" type="button" name="submit" id="add_showtime" />
            </div>
        </form>
    </div>

</body>
</html>