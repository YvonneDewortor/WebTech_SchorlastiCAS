<?php
    session_start();

    
    if (!isset($_SESSION["admin_logged_in"])){
        $_SESSION["admin_logged_in"] = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- CSS -->
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link type="text/css" rel="stylesheet" href="../css/admin_forms.css">
    <link type="text/css" rel="stylesheet" href="../css/admin_login.css">
    <title>Home - Admin</title>
</head>
<body>

    <div class="container">
        
        <?php
            if ($_SESSION['admin_logged_in'] == 1) {
                echo "<h2> Logged in as, ".$_SESSION['admin_name']."</h2>";
                echo "<a href='' id='logout'><i class='fas fa-sign-out-alt'></i></a>";
            }
        ?>
        <h2>Modify Flicks</h2>

        <div class="wrapper">
            <nav class="tabs">
                <div class="selector"></div>
                <a href="index.php" class="active"><i class="fas fa-plus"></i>Add</a>
                <a href="index.php"><i class="far fa-edit"></i>Update</a>
                <a href="index.php"><i class="fas fa-trash-alt"></i>Delete</a>
            </nav>
        </div>

        <h1 id="flick_action">Insert an Entry!</h1>

        <div class="home-fields">
            <br/>
            <div>
                <a id="add_a_cinema" href="add_forms/add_cinema.php"> ADD A CINEMA </a>
            </div>
            <br/>
            <div>
                <a id="add_a_theatre" href="add_forms/add_theatre.php"> ADD A THEATRE </a>
            </div>
            <br/>
            <div>
                <a id="add_a_movie" href="add_forms/add_movie.php"> ADD A MOVIE </a>
            </div>
            <br/>
            <div>
                <a id="add_a_showtime" href="add_forms/add_showtime.php"> ADD A SHOWTIME </a>
            </div>
        </div>

    </div>

    <div id="overlay">
        <div id="login-form">
            <h1>Login</h1>
            <div id="login-img">
                <img src="../img/authentication_illustration.svg" alt="authentication_img"></img> 
            </div>
            <form action="../common/submit_admin_forms.php" method="POST" class="form-container">
                <input name="admin_login_post" id="admin_login_post" type="hidden" value="empty">
                <br>
                
                <input name="admin_name" id="admin_name" type="text" placeholder="Enter Name" required>

                <br>
                
                <input name="admin_password" id="admin_password" type="password" placeholder="Enter Password" required>

                <input id="admin_login" value="Login" type="submit" name="submit">
                
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../js/admin_page_nav.js"></script>
    <script>
        $(document).ready(function() {
            if ("<?php echo $_SESSION['admin_logged_in']; ?>" != 1) {
                $("#overlay").show();
            } else {
                $("#overlay").hide();
            }
        });
        $('#logout').click( function(e) {
            e.preventDefault();
            <?php session_unset();?>
            <?php session_destroy();?>
            window.location.href="index.php";
            return false;
        });
    </script>
</body>
</html>