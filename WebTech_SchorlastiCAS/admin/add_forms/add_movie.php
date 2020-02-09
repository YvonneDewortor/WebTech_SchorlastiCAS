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
    <title>Add a New Movie</title>
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
        <h2>New Movie</h2>
        <h1>Add a new movie!</h1>
    
        <form action="../../common/submit_admin_forms.php" method="POST" id="add_movie_form" enctype="multipart/form-data">
            <div class="fields">
                <input type="hidden" name="movie_post" id="movie_post" value="empty" />
                <span>
                    <input name="movie_title" id="movie_title" placeholder="Title" type="text" required />
                </span>
                <br />
                <span>
                    <input name="movie_genre" id="movie_genre" placeholder="Genre" type="text" required />
                </span>
                <br />
                <span>
                    <textarea name="movie_about" id="movie_about" placeholder="Description" rows="10"></textarea>
                    <!-- <input name="movie_about" id="movie_about" placeholder="About" type="textarea" required /> -->
                </span>
                <!-- <br />
                <span>
                    <select name="movie_theatre" id="movie_theatre" required>
                        <option value="" selected="selected">Select a theatre</option>
                        <?php
                            // require_once("../../db/theatre.php");
                            // // Generate all cinemas
                            // // Make <option> text the cinema_name, and cinema_id the the value
                            // $theatre = new Theatre();
                            // $result = $theatre->all_theatre();
                            
                            // if ($result->num_rows > 0) {

                            //     while($row = $result->fetch_assoc()) {
                            //         echo '<option value="'.$row['Theatre_ID'].'">'.$row['Theatre_Name'].'</option>';
                            //     }

                            // }
                        ?>
                    </select>
                </span> -->
                <br />
                <span>
                    <label for="movie_cover" class="custom-file-upload"><i class="fas fa-upload"></i>Upload Movie Cover</label>
                    <input name="movie_cover" id="movie_cover" type="file" accept="image/*" required>
                </span>
            </div>
            <div class="submit">
                <input class="submit" value="Submit" type="submit" name="submit" id="add_movie" />
            </div>
        </form>
    </div>

</body>
</html>