<?php
session_start();
require_once('config.php');

$username = $password = $email = $fullname = $phone = $city = $street = $created_time = "";
$username_err = $password_err = $email_err = "";
$errors = array(); 

//Logout
if ($_POST["action"] == "logout") {
    session_unset(); 
    session_destroy();
}

//login
if ($_POST["action"] == "login") {
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    $password = md5($password);
    if(count($errors) == 0){
        $user_check_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if ($user) { // if user exists
            $_SESSION["username"] = $user['username'];
            $_SESSION["fullname"] = $user['fullname'];
            $_SESSION["role"] = $user['role'];
        }
        else{
            $html = '<div class="alert alert-danger" role="alert">Sorry! But we couldnt verify your accout</div>';
            echo $html;
        }
    }
    else {
        $html = '<div class="alert alert-danger" role="alert"><ul>';
            foreach ($errors as $value)
            $html .= '
            <li>'.$value.'</li>
            ';
            $html .= '</ul></div>';
            echo $html;
    }
}
?>