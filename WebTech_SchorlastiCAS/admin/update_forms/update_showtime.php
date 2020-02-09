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
    <title>Update Movie Showtime</title>
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
        <h2>Update Flicks</h2>
        <h1>Update a movie showtime!</h1>

        <div class="entry-selection" id="selection_div">
            <input type="hidden" name="get_showtime_data" id="get_showtime_data" value="empty" />
            <input name="showtime_id" id="showtime_id" placeholder="Showtime ID" type="text" readonly />
            <select name="showtime_selection" id="showtime_selection">
                <option value="" selected="selected">Select a Showtime</option>
                <?php
                    require_once("../../db/movietime.php");
                    require_once("../../db/movie.php");
                    $showtime = new MovieTime();
                    $movie = new Movie();
                    $result = $showtime->all_movie_times();

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $movie_result = $movie->get_movie($row['Movie_ID']);
                            $movie_result_row = $movie_result->fetch_assoc();
                            echo '<option value="'.$row['Movie_Time_ID'].'">'.$movie_result_row["Movie_Title"]." (".$row['Movie_Time'].") : ".$row['ShowingDate_Start']." - ".$row['ShowingDate_End'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <!-- Update data in form based on button click -->
        <div class="entry-selection-btn">
            <button id="get_showtime_data_btn">Get Showtime</button>
        </div>
    
        <form action="" method="POST" id="update_showtime_form">
            <div class="fields">
                <input type="hidden" name="showtime_update_post" id="showtime_update_post" value="empty" />
                <span>
                    <select name="showtime_movie" id="showtime_movie" required>
                        <option value="" selected="selected">Select a Movie</option>
                        <?php
                            require_once("../../db/movie.php");
                            // Generate all showtimes
                            // Make <option> text the showtime_name, and showtime_id the the value
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
                <input class="submit" value="Submit" type="button" name="submit" id="update_showtime" />
            </div>
        </form>
    </div>

</body>
</html>