<?php
session_start();
require_once('config.php');

$name = $address = $city = $sport_type = $num_of_players = $status = '';
$user_owner = $_SESSION["username"];
$date_of_create = date("Y-m-d");

$errors = array(); 

//Add new space
if (isset($_POST["space_name"])) {
    $name = mysqli_real_escape_string($db, $_POST["space_name"]);
    $address = mysqli_real_escape_string($db, $_POST["space_address"]);
    $city = mysqli_real_escape_string($db, $_POST["space_city"]);
    $sport_type = mysqli_real_escape_string($db, $_POST["space_sport_type"]);
    $num_of_players = mysqli_real_escape_string($db, $_POST["space_num_players"]);
    $features = mysqli_real_escape_string($db, $_POST["features_sum"]);
    $status = "open";
    
    if (empty($name) || empty($address) || empty($city) || empty($sport_type) || empty($num_of_players)) { array_push($errors, "All fields required"); }

    $image_target_dir = "/urbanspace/include/spaces/";
    $image_target_file = $image_target_dir . $name;
    $uploadOk = 1;
    $imageFileType = ltrim($_FILES["space_image"]["type"], "image/");
    
    // Check if file already exists
    if (file_exists($image_target_file)) {
        array_push($errors, "Sorry, file already exists.");
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["space_image"]["size"] > 500000) {
        array_push($errors, "Sorry, your file is too large.");
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }
    echo $_FILES["space_image"]["tmp_name"];
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        array_push($errors, "Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["space_image"]["tmp_name"], $image_target_file)) {
            echo "The file ". basename( $_FILES["space_image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $html = '<div class="alert alert-danger" role="alert"><ul>';
            foreach ($errors as $value)
            $html .= '
            <li>'.$value.'</li>
            ';
            $html .= '</ul></div>';
            echo $html;
    //header("Location: /urbanspace/index.php");
}

?>