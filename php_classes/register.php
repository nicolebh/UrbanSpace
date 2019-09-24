<?php
session_start();
require_once('config.php');

// initializing variables
$username = $password = $email = $fullname = $phone = $city = $street = $created_time = "";
$username_err = $password_err = $email_err = "";
$errors = array(); 

// REGISTER USER
if ($_POST["action"] == "register") {
    // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $fullname = mysqli_real_escape_string($db, $_POST["fullname"]);
  $phone = mysqli_real_escape_string($db, $_POST["phone"]);
  $city = mysqli_real_escape_string($db, $_POST["city"]);
  $street = mysqli_real_escape_string($db, $_POST["street"]);
  $created_time = date("Y-m-d h:i:s");
  // $terms = $_POST["terms"];
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($fullname)) { array_push($errors, "Full name is required"); }
<<<<<<< HEAD
  if (strrpos($fullname, ' ')) { array_push($errors, "Full name is required"); }
=======
>>>>>>> e011addcd93f0b8b067c4686ba03282ccd83eff1
  if (empty($phone)) { array_push($errors, "Phone is required"); }
  if (empty($city)) { array_push($errors, "City is required"); }
  if (empty($street)) { array_push($errors, "Street is required"); }
  
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

// REGISTER USER via google sign in
if ($_POST["action"] == "google_signin") {
  // receive all input values from the form
$username = mysqli_real_escape_string($db, $_POST["username"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$fullname = mysqli_real_escape_string($db, $_POST["fullname"]);
$created_time = date("Y-m-d h:i:s");

// form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($username)) { array_push($errors, "Username is required"); }
if (empty($email)) { array_push($errors, "Email is required"); }

// first check the database to make sure 
// a user does not already exist with the same username and/or email
$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
if($result!=false){
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user["username"] === $username) {
      $_SESSION["username"] = $username;
      $_SESSION["fullname"] = $fullname;

      $user_role_query = "SELECT role FROM users WHERE username='$username' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      $_SESSION["role"] = $user['role'];
    }
  }
  else {
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {

          //$username = $password = $email = $fullname = $phone = $city = $street = $created_time = "";
          $query = "INSERT INTO users (username, email, fullname, created_time ) 
                VALUES('$username', '$email', '$fullname', '$created_time')";
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
            $_SESSION["role"] = 'user';
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
}
}

?>