<?php

session_start();

require_once("../db/user.php");


if (isset($_POST["submit"])) {

    $temp = new user();

    if ($temp->get_user_byusername($_POST['user_name']) > 0) {
        echo "<script> alert('Registration Failed: Your Username is already taken please try different one.');
        window.location.href = 'register.php'; </script>";
        exit();

    } elseif ($temp->get_user_byemail($_POST['user_email']) > 0) {
        echo "<script> alert('Registration Failed: Your email is already taken please try again.');
        window.location.href = 'register.php'; </script>";
        exit();

    } elseif(md5($_POST['user_password']) != md5($_POST['user_password2'])) {
        echo "<script> alert('Registration Failed: Your passwords do not match.');
        window.location.href = 'register.php'; </script>";
        exit();

    } else {
        add_new_user($_POST["user_name"], md5($_POST["user_password"]), $_POST["first_name"], $_POST["last_name"], $_POST["gender"], $_POST["date_of_birth"], $_POST["nationality"], $_POST["address"], $_POST["user_email"], $_POST["contact_number"]);
        $_SESSION['register_success'] = 1;
    } 
    
}

function add_new_user($user_name, $user_password, $first_name, $last_name, $gender, $date_of_birth, $nationality, $address, $user_email, $contact_number) {
    $user = new user($user_name = $user_name, $user_password = $user_password, $first_name = $first_name, $last_name = $last_name, $gender = $gender, $date_of_birth = $date_of_birth, $nationality = $nationality, $address = $address, $user_email = $user_email, $contact_number = $contact_number);
    $user->create();

}



header('Location: register.php');
exit();

?>

