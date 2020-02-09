<?php

session_start();

?>

<?php

require_once("../db/user.php");

function sanitizeData($input) {
    $data = trim($input);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST["submit"])) {
    
    $user_name = sanitizeData($_POST['user_name']);
	$user_password = sanitizeData($_POST['user_password']);
    
    $user_password = md5($user_password);

    $user = new user($user_name = $user_name, $user_password = $user_password, null, null, null, null, null, null, null);

    $result = $user->get_user();

    if ($result == 0) {
        echo "<script>
        alert('Login Failed: Please try again. If you do not have an account please click Sign Up');
        window.location.href='login.php';
        </script>";

        
    } else {
        
        $_SESSION["user_name"] = $user_name;
        header('Location: movie_view.php');
        exit();
        
    }

    

}

?>