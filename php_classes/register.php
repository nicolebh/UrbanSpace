<?php
session_start();
require_once('config.php');

// initializing variables
$username = $password = $email = $fullname = $phone = $city = $street = $created_time = "";
$username_err = $password_err = $email_err = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST["username"])) {
    // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $fullname = mysqli_real_escape_string($db, $_POST["fullname"]);
  $phone = mysqli_real_escape_string($db, $_POST["phone"]);
  $city = mysqli_real_escape_string($db, $_POST["city"]);
  $street = mysqli_real_escape_string($db, $_POST["street"]);
  $created_time = date("Y-m-d h:i:s");
  $terms = $_POST["terms"];
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($terms=='false') { array_push($errors, "You must read and accept the terms"); }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  if($result!=false){
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user["username"] === $username) {
        array_push($errors, "Username already exists");
      }

      if ($user["email"] === $email) {
        array_push($errors, "email already exists");
      }
    }
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

    //$username = $password = $email = $fullname = $phone = $city = $street = $created_time = "";
  	$query = "INSERT INTO users (username, email, password, fullname, phone, city, street, created_time ) 
          VALUES('$username', '$email', '$password', '$fullname', $phone, '$city', '$street', '$created_time')";
  	if(!mysqli_query($db, $query)){
      array_push($errors, "Error while trying to run the following on the DB: <br>" . $query);
      $html = '<div class="alert alert-danger" role="alert"><ul>';
      foreach ($errors as $value)
        $html .= '
        <li>'.$value.'</li>
        ';
      $html .= '</ul></div>';
      echo $html;
    }
    else {
      $_SESSION["username"] = $username;
      $_SESSION["fullname"] = $fullname;
      $user_role_query = "SELECT role FROM users WHERE email='$email' AND password='$password' LIMIT 1";
      $result = mysqli_query($db, $user_role_query);
      $user = mysqli_fetch_assoc($result);
      $_SESSION["role"] = $user['role'];
      $_SESSION["success"] = "You are now logged in";
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
