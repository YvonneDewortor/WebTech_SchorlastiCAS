<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/movie_view.js"></script>
    
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/movie_view.css">
    <link href="https://fonts.googleapis.com/css?family=Lexend+Mega&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link type="text/css" rel="stylesheet" href="../css/movie_payment.css">
    <title>FlickTick - Flicks</title>
</head>

<body onload="check_user();">

    <header>
        <div class="nav_container">
            <h1 style="color: black; font-family: 'Lexend Mega', sans-serif;" class="home">
                FLICKS
            </h1>
            <div id="user_div" style="display: inline-block; float: right;">
                <i class="fas fa-user prefix black-text active" style="display: none;" id="login_icon"></i>
                <h3 id="user_info"></h3>
            </div>
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="">Profile</a></li>
                    <li style="display: none;" id="logout_icon"><a href="logout_check.php">Log Out</a></li>
                </ul>
            </nav>
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
            </label>
        </div>
    </header>

    <div class="main_container" style="display: block;">

        <div class="container">
            <div class="card">
                <img src="../img/animation.png">
            </div>
            <?php

                require_once("../db/movie.php");

                $movie = new Movie();
                $result = $movie->all_movies_by_genre("Animation");
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card movie-card"> <img src="'.$row["Movie_Cover"].'"> <div class="card__head" id="'.$row["Movie_ID"].'">'.$row["Movie_Title"].'</div> </div>';
                    }
                }
            ?>
        </div>

        <br>

        <div class="container">
            <div class="card">
                <img src="../img/drama.png">
            </div>
            <?php

                require_once("../db/movie.php");

                $movie = new Movie();
                $result = $movie->all_movies_by_genre("Drama");
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card movie-card"> <img src="'.$row["Movie_Cover"].'"> <div class="card__head" id="'.$row["Movie_ID"].'">'.$row["Movie_Title"].'</div> </div>';
                    }
                }

            ?>
        </div>

        <br>

        <div class="container">
            <div class="card">
                <img src="../img/comedy.png">
            </div>
            <?php

                require_once("../db/movie.php");

                $movie = new Movie();
                $result = $movie->all_movies_by_genre("Comedy");
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card movie-card"> <img src="'.$row["Movie_Cover"].'"> <div class="card__head" id="'.$row["Movie_ID"].'">'.$row["Movie_Title"].'</div> </div>';
                    }
                }
            ?>
        </div>

        <br>

        <div class="container">
            <div class="card">
                <img src="../img/action.png">
            </div>
            <?php

                require_once("../db/movie.php");

                $movie = new Movie();
                $result = $movie->all_movies_by_genre("Action");
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card movie-card"> <img src="'.$row["Movie_Cover"].'"> <div class="card__head" id="'.$row["Movie_ID"].'">'.$row["Movie_Title"].'</div> </div>';
                    }
                }
            ?>
        </div>
    </div>

    <div id="overlay"></div>

    <script type="text/javascript">

        function check_user(){
            var user_div = document.getElementById("user_div");
            var user_info = document.getElementById("user_info");

            if ("<?php echo $_SESSION['user_name']; ?>") {
                user_info.innerHTML = "Welcome " + "<?php echo $_SESSION['user_name']; ?>";
                document.getElementById("login_icon").style.display = "inline-block";
                document.getElementById("logout_icon").style.display = "inline-block";
            }
        }
        
    </script>

</body>

</html>