<?php

session_start();

require_once("../db/cinema.php");
require_once("../db/theatre.php");
require_once("../db/movie.php");
require_once("../db/movietime.php");
require_once("../db/admin.php");

// Handling POST Requests
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if admin exists
    if (isset($_POST["admin_name"])) {

        $admin_name = sanitizeData($_POST["admin_name"]);
        $admin_pass = md5(sanitizeData($_POST["admin_password"]));

        find_admin($admin_name, $admin_pass);
    }

    // Adding a Cinema
    if (isset($_POST["cinema_post"])) {

        $cinema_name = sanitizeData($_POST["c_name"]);
        $cinema_address = sanitizeData($_POST["c_address"]);
        $cinema_telephone = sanitizeData($_POST["c_telephone"]);
        $cinema_email = sanitizeData($_POST["c_email"]);

        add_new_cinema($cinema_name, $cinema_address, $cinema_telephone, $cinema_email);
    }

    // Updating a Cinema
    if (isset($_POST["cinema_update_post"])) {

        $cinema_name = sanitizeData($_POST["c_name"]);
        $cinema_address = sanitizeData($_POST["c_address"]);
        $cinema_telephone = sanitizeData($_POST["c_telephone"]);
        $cinema_email = sanitizeData($_POST["c_email"]);

        update_cinema($_POST["cinema_update_post"], $cinema_name, $cinema_address, $cinema_telephone, $cinema_email);
    }

    // Deleting a Cinema
    if (isset($_POST["cinema_delete_post"])) {
        $cinema_id = $_POST["c_id"];

        delete_cinema($cinema_id);
    }

    // Adding a Theatre
    elseif (isset($_POST["theatre_post"])) {

        $theatre_name = sanitizeData($_POST["t_name"]);
        $theatre_cinema = sanitizeData($_POST["t_cinema"]);

        add_new_theatre($theatre_name, $theatre_cinema);
    }

    // Updating a Theatre
    elseif (isset($_POST["theatre_update_post"])) {
 
        $theatre_name = sanitizeData($_POST["t_name"]);
        $theatre_cinema = sanitizeData($_POST["t_cinema"]);

        update_theatre($_POST["theatre_update_post"], $theatre_name, $theatre_cinema);
    }

    // Deleting a Theatre
    elseif (isset($_POST["theatre_delete_post"])){
        $theatre_id = $_POST["t_id"];

        delete_theatre($theatre_id);
    }

    // Adding or Updating a Movie
    elseif (isset($_POST["movie_post"]) || isset($_POST["movie_update_post"])) {

        $alert_messages = [];

        $target_dir = "../img/MovieCovers/".sanitizeData($_POST["movie_genre"])."/";
        $target_file = $target_dir . basename($_FILES["movie_cover"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["movie_cover"]["tmp_name"]);
        if($check !== false) {
            array_push($alert_messages, "alert('File is an image - " . $check["mime"] . ".'); ");
            $uploadOk = 1;
        } else {
            array_push($alert_messages, " alert('File is not an image.'); ");
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            array_push($alert_messages, " alert('Sorry, file already exists.'); ");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["movie_cover"]["size"] > 5000000) {
            array_push($alert_messages, " alert('Sorry, your file is too large.'); ");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            array_push($alert_messages, " alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); ");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($alert_messages, " alert('Sorry, your file was not uploaded.'); ");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["movie_cover"]["tmp_name"], $target_file)) {
                array_push($alert_messages, " alert('The file ". basename( $_FILES["movie_cover"]["name"]). " has been uploaded.'); ");
            } else {
                array_push($alert_messages, " alert('Sorry, there was an error uploading your file.');");
            }
        }

        $movie_title = sanitizeData($_POST["movie_title"]);
        $movie_genre = sanitizeData($_POST["movie_genre"]);
        $movie_about = sanitizeData($_POST["movie_about"]);
        // $movie_theatre = sanitizeData($_POST["movie_theatre"]);
        $movie_cover = $target_file;

        if (isset($_POST["movie_update_post"])){
            // update_movie($_POST["movie_update_post"], $movie_title, $movie_genre, $movie_about, $movie_theatre, $movie_cover);
            update_movie($_POST["movie_update_post"], $movie_title, $movie_genre, $movie_about, $movie_cover);

            $all_alert_messages = "";

            for ($i = 0; $i < count($alert_messages); $i++) {
                $all_alert_messages = $all_alert_messages . $alert_messages[$i];
            }

            echo ("<script language='javascript'>" . $all_alert_messages . "window.location.href='../admin/update_forms/update_movie.php'; </script>");
        }
        else {
            // add_new_movie($movie_title, $movie_genre, $movie_about, $movie_theatre, $movie_cover);
            add_new_movie($movie_title, $movie_genre, $movie_about, $movie_cover);

            $all_alert_messages = "";

            for ($i = 0; $i < count($alert_messages); $i++) {
                $all_alert_messages = $all_alert_messages . $alert_messages[$i];
            }

            echo ("<script language='javascript'>" . $all_alert_messages . "window.location.href='../admin/add_forms/add_movie.php'; </script>");
        }
    }

    // Deleting a Movie
    elseif (isset($_POST["movie_delete_post"])) {
        $movie_id = $_POST["m_id"];

        delete_movie($movie_id);
    }

    // Adding a ShowTime(MovieTime)
    elseif (isset($_POST["showtime_post"])) {

        $showtime_movie_id = $_POST["showtime_movie_id"];
        $showtime = $_POST["showtime"];
        $showdate_start = $_POST["showdate_start"];
        $showdate_end = $_POST["showdate_end"];
        $showtime_theatre = $_POST["showtime_theatre"];

        add_new_showtime($showtime_movie_id, $showtime, $showdate_start, $showdate_end, $showtime_theatre);
    }

    // Updating a ShowTime(MovieTime)
    elseif (isset($_POST["showtime_update_post"])) {
        $showtime_movie_id = $_POST["showtime_movie_id"];
        $showtime = $_POST["showtime"];
        $showdate_start = $_POST["showdate_start"];
        $showdate_end = $_POST["showdate_end"];
        $showtime_theatre = $_POST["showtime_theatre"];

        update_showtime($_POST["showtime_update_post"], $showtime_movie_id, $showtime, $showdate_start, $showdate_end, $showtime_theatre);
    }

    // Deleting a ShowTime(MovieTime)
    elseif (isset($_POST["showtime_delete_post"])) {
        $showtime_id = $_POST["s_id"];

        delete_showtime($showtime_id);
    }
}

// Handling GET Requests
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Loading Cinema data
    if (isset($_GET["get_cinema_data"])) {
        $cinema = new Cinema();
        $result = $cinema->get_cinema($_GET["c_id"]);
        $row = $result->fetch_assoc();
        $ret_arr = [$row['Cinema_Name'], $row['Cinema_Address'], $row['Cinema_Telephone'], $row['Cinema_Email']];
        echo json_encode($ret_arr);
    }

    // Loading Movie data
    if (isset($_GET["get_movie_data"])) {
        $movie = new Movie();
        $result = $movie->get_movie($_GET["m_id"]);
        $row = $result->fetch_assoc();
        $ret_arr = [$row['Movie_Title'], $row['Movie_Genre'], $row['About_Movie']];
        echo json_encode($ret_arr);
    }

    // Loading Theatre data
    if (isset($_GET["get_theatre_data"])) {
        $theatre = new Theatre();
        $result = $theatre->get_theatre($_GET["t_id"]);
        $row = $result->fetch_assoc();
        $ret_arr = [$row['Theatre_Name'], $row['Cinema_ID']];
        echo json_encode($ret_arr);
    }

    // Loading Showtime(MovieTime) data
    if (isset($_GET["get_showtime_data"])) {
        $movietime = new MovieTime();
        $result = $movietime->get_movie_time($_GET["s_id"]);
        $row = $result->fetch_assoc();
        $ret_arr = [$row["Movie_ID"], $row["Movie_Time"], $row["ShowingDate_Start"], $row["ShowingDate_End"],  $row["Theatre_ID"]];
        echo json_encode($ret_arr);
    }

    // Loading all Cinema
    if (isset($_GET["get_all_cinema"])) {
        $cinema = new Cinema();
        $result = $cinema->all_cinema();
        $ret_json = [];
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ret_json[$row["Cinema_Name"]] = $row["Cinema_ID"];
                $i += 1;
            }
        }
        echo json_encode($ret_json);
    }

    // Loading all Theatre
    if (isset($_GET["get_all_theatre"])) {
        $theatre = new Theatre();
        $result = $theatre->all_theatre();
        $ret_json = [];
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ret_json[$row["Theatre_Name"]] = $row["Theatre_ID"];
                $i += 1;
            }
        }
        echo json_encode($ret_json);
    }

    // Loading all Movie
    if (isset($_GET["get_all_movie"])) {
        $movie = new Movie();
        $result = $movie->all_movies();
        $ret_json = [];
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ret_json[$row["Movie_Title"]] = $row["Movie_ID"];
                $i += 1;
            }
        }
        echo json_encode($ret_json);
    }

    // Loading all Showtime(MovieTime)
    if (isset($_GET["get_all_showtime"])) {
        $showtime = new MovieTime();
        $result = $showtime->all_movie_times();
        $ret_json = [];
        $i = 0;
        $movie = new Movie();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $movie_result = $movie->get_movie($row['Movie_ID']);
                $movie_result_row = $movie_result->fetch_assoc();
                $ret_json[$movie_result_row["Movie_Title"]." (".$row['Movie_Time'].") : ".$row['ShowingDate_Start']." - ".$row['ShowingDate_End']] = $row["Movie_Time_ID"];
                $i += 1;
            }
        }
        echo json_encode($ret_json);
    }
}


function add_new_cinema($cinema_name, $cinema_address, $cinema_telephone, $cinema_email) {
    $cinema = new Cinema($cinema_name = $cinema_name, $cinema_address = $cinema_address, $cinema_telephone = $cinema_telephone, $cinema_email = $cinema_email);
    echo $cinema->create();
}

function add_new_theatre($theatre_name, $theatre_cinema) {
    $theatre = new Theatre($theatre_name = $theatre_name, $cinema_id = $theatre_cinema);
    echo $theatre->create();
}

function add_new_movie($movie_title, $movie_genre, $movie_about, $movie_cover){
    $movie = new Movie($movie_title = $movie_title, $movie_about = $movie_about, $movie_genre = $movie_genre, $movie_cover = $movie_cover);
    echo $movie->create();
}

function add_new_showtime($showtime_movie_id, $showtime, $showdate_start, $showdate_end, $showtime_theatre){
    $showtime = new MovieTime($movie_id = $showtime_movie_id, $movie_time = $showtime, $showingdate_start = $showdate_start, $showingdate_end = $showdate_end, $theatre_id = $showtime_theatre);
    echo $showtime->create();
}

function update_cinema($cinema_id, $cinema_name, $cinema_address, $cinema_telephone, $cinema_email) {
    $cinema = new Cinema($cinema_name = $cinema_name, $cinema_address = $cinema_address, $cinema_telephone = $cinema_telephone, $cinema_email = $cinema_email);
    echo $cinema->update($c_id = $cinema_id);
}

function update_theatre($theatre_id, $theatre_name, $theatre_cinema) {
    $theatre = new Theatre($theatre_name = $theatre_name, $cinema_id = $theatre_cinema);
    echo $theatre->update($t_id = $theatre_id);
}

function update_movie($movie_id, $movie_title, $movie_genre, $movie_about, $movie_cover){
    $movie = new Movie($movie_title = $movie_title, $movie_about = $movie_about, $movie_genre = $movie_genre, $movie_cover = $movie_cover);
    echo $movie->update($m_id = $movie_id);
}

function update_showtime($movie_time_id, $showtime_movie_id, $showtime, $showdate_start, $showdate_end, $showtime_theatre){
    $showtime = new MovieTime($movie_id = $showtime_movie_id, $movie_time = $showtime, $showingdate_start = $showdate_start, $showingdate_end = $showdate_end, $theatre_id = $showtime_theatre);
    echo $showtime->update($movie_time_id);
}

function delete_cinema($cinema_id){
    $cinema = new Cinema();
    echo $cinema->delete($c_id = $cinema_id);
}

function delete_theatre($theatre_id){
    $theatre = new Theatre();
    echo $theatre->delete($t_id = $theatre_id);
}

function delete_movie($movie_id){
    $movie = new Movie();
    echo $movie->delete($m_id = $movie_id);
}

function delete_showtime($showtime_id){
    $showtime = new MovieTime();
    echo $showtime->delete($showtime_id);
}

function find_admin($admin_name, $admin_pass){
    $admin = new Admin();
    $result = $admin->get_admin($admin_name, $admin_pass);

    if ($result == "Error during selection" || $result == 0){
        header("Location: ../admin/index.php");
    }
    else {
        $_SESSION['admin_logged_in'] = 1;
        $_SESSION['admin_name'] = $admin_name;
        header("Location: ../admin/index.php");
        exit();
    }
}

function sanitizeData($text) {
    $text = strip_tags($text);
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}

?>