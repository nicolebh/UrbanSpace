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

    $image_target_dir = "../include/spaces/";
    $uploadOk = 1;
    $imageFileType = ltrim($_FILES["space_image"]["type"], "image/");
    $image_target_file = $image_target_dir . $name . "." . $imageFileType;
    
    // Check if file already exists
    if (file_exists($image_target_file)) {
        array_push($errors, "Sorry, file already exists.");
        $uploadOk = 0;
    }
    else {
        mkdir("../include/spaces", 0777, true);
    }
    // Check file size
    if ($_FILES["space_image"]["size"] > 5000000) {
        array_push($errors, "Sorry, your file is too large.");
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        array_push($errors, "Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
    } else {
        
        if (move_uploaded_file($_FILES["space_image"]["tmp_name"], $image_target_file)) {
            $query = "INSERT INTO spaces (name, address, city, sport_type, num_of_players, features, date_of_create, image, user_owner, status ) 
            VALUES('$name','$address','$city','$sport_type','$num_of_players','$features','$date_of_create','/urbanspace/include/spaces/$name.$imageFileType','$user_owner','open')";
            if(!mysqli_query($db, $query)){
            array_push($errors, "Error while trying to run the following on the DB: <br>" . $query);
            $html = '<div class="alert alert-danger" role="alert"><ul>';
            foreach ($errors as $value)
                $html .= '
                <li>'.$value.'</li>
                ';
            $html .= '</ul></div>';
            echo $html;
            } else {
                header("Location: /urbanspace/index.php?test=1");
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $html = '<div class="alert alert-danger" role="alert">Sorry, all fields mandatory</div>';
            echo $html;
    // header("Location: /urbanspace/index.php?test=2");
}

// Get a list of features
if ($_POST["action"] == "get_features") {
    $html = '<label for="space_features">Features (select many)</label>
                <select multiple class="form-control" name="space_features" id="space_features">
    ';
    $query = "SELECT * FROM features";
    $result = mysqli_query($db, $query);

    while($row = $result->fetch_assoc()) {
        $html .= '<option>' . $row['feature'] . '</option>';
    }
    $html .= '
            </select>
            <input type="text" name="features_sum" id="features_sum" style="visibility: hidden;"></span>
    ';
    echo $html;
}

// Get a list of spaces owned by the user
if ($_POST["action"] == "get_spaces") {
    $html = '';
    $query = "SELECT id,name,address,city,image,status FROM spaces WHERE user_owner='$user_owner'";
    $result = mysqli_query($db, $query);

    while($row = $result->fetch_assoc()) {
        $html .= '
            <li class="media" id="spaceBox-'.$row["id"].'">
                <img src="' . $row["image"] . '" class="mr-3 img-thumbnail h-5" style="max-width:30%;" alt="...">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">' . $row["name"] . '</h5>
                    ' . $row["address"] . ', ' . $row["city"] . '<br>
                    <strong>Status:</strong><span id="status_lbl"> ' . $row["status"] . '</span><br>
                    <br>
                    <a class="btn btn-danger btn-sm" href="#" onclick="handle_remove_space_btn('.$row["id"].')" id="remove_space_btn" role="button">Remove Space</a>
                    ';
        if($row['status'] == 'open') {
            $html .= '<a class="btn btn-warning btn-sm" href="#" style="display:inline;" onclick="handle_shut_space_btn('.$row["id"].')" id="shut_space_btn_'.$row["id"].'" role="button">Shut Space</a>
                    <a class="btn btn-success btn-sm" href="#" style="display:none;" onclick="handle_open_space_btn('.$row["id"].')" id="open_space_btn_'.$row["id"].'" role="button">Open Space</a>  
                    </div>
            ';
        }
        else {
            $html .= '<a class="btn btn-warning btn-sm" href="#" style="display:none;" onclick="handle_shut_space_btn('.$row["id"].')" id="shut_space_btn_'.$row["id"].'" role="button">Shut Space</a>
                    <a class="btn btn-success btn-sm" href="#" style="display:inline;" onclick="handle_open_space_btn('.$row["id"].')" id="open_space_btn_'.$row["id"].'" role="button">Open Space</a>
                    </div>
            ';
        }
        $html .='
                </li>
                <hr>
        ';
    }
    echo $html;
}

// Remove a space
if ($_POST["action"] == "remove_space") {
    $id = mysqli_real_escape_string($db, $_POST["spaceId"]);
    $query = "DELETE FROM spaces WHERE id=$id";
    if(!mysqli_query($db, $query)){
        echo "Error while trying to remove space";
    }
}

// Shut a space
if ($_POST["action"] == "shut_space") {
    $id = mysqli_real_escape_string($db, $_POST["spaceId"]);
    $query = "UPDATE spaces SET status='close' WHERE id=$id";
    
    if(!mysqli_query($db, $query)){
        echo "Error while trying to remove space";
    }
}

// Open a space
if ($_POST["action"] == "open_space") {
    $id = mysqli_real_escape_string($db, $_POST["spaceId"]);
    $query = "UPDATE spaces SET status='open' WHERE id=$id";
    
    if(!mysqli_query($db, $query)){
        echo "Error while trying to remove space";
    }
}


// Get a list of issues for spaces owned by the user
if ($_POST["action"] == "get_reports") {
    $html = '';
    $query = "SELECT * FROM reports WHERE space_owner='$user_owner' AND status='open'";
    $result = mysqli_query($db, $query);
    while($row = $result->fetch_assoc()) {
        $query2 = "SELECT status, name FROM spaces WHERE id=".$row['space_id']." LIMIT 1";
        $result2 = mysqli_query($db, $query2);
        $row2 = $result2->fetch_assoc();

        $html .= '
                <li class="media" id="issueBox-'.$row['id'].'">
                <img src="'.$row['image'].'" class="mr-3 img-thumbnail h-5" style="max-width:30%;" alt="...">
                <div class="media-body">
                <h5 class="mt-0 mb-1">Issue Num: <small>#'.$row['id'].'</small></h5>
                <h5 class="mt-0 mb-1">Space: <small>'.$row2['name'].'</small></h5>
                <h5 class="mt-0 mb-1">Date: <small>'.$row['date_of_create'].'</small></h5>
                <h5 class="mt-0 mb-1">Issue Description:</h5>
                <p>
                   '.$row['description'].'             
                </p>
                <a class="btn btn-success btn-sm" href="#" onclick="handle_resolve_issue_btn('.$row['id'].')" role="button">Resolve Issue</a>
                ';
                
        if($row2['status'] == 'open') {
            $html .= '<a class="btn btn-warning btn-sm" href="#" style="display:inline;" onclick="handle_shut_space_btn('.$row["space_id"].')" id="shut_space_btn_'.$row["id"].'" role="button">Shut Space</a>
                    <a class="btn btn-info btn-sm" href="#" style="display:none;" onclick="handle_open_space_btn('.$row["space_id"].')" id="open_space_btn_'.$row["id"].'" role="button">Open Space</a>  
                    </div>
            ';
        }
        else {
            $html .= '<a class="btn btn-warning btn-sm" href="#" style="display:none;" onclick="handle_shut_space_btn('.$row["space_id"].')" id="shut_space_btn_'.$row["id"].'" role="button">Shut Space</a>
                    <a class="btn btn-info btn-sm" href="#" style="display:inline;" onclick="handle_open_space_btn('.$row["space_id"].')" id="open_space_btn_'.$row["id"].'" role="button">Open Space</a>
                    </div>
            ';
        }
        $html .='
                <span id="issue_status_lbl"></span>
                </li>
                <hr>
        ';
    }
    echo $html;
}

// Resolve an issues
if ($_POST["action"] == "resolve_issue") {
    $id = mysqli_real_escape_string($db, $_POST["spaceId"]);
    $query = "UPDATE reports SET status='closed' WHERE id=$id";

    if(!mysqli_query($db, $query)){
        echo "Error while trying to remove space";
    }
    else {
        
        $query = "SELECT users.email,users.fullname FROM reports INNER JOIN users on users.username = reports.issue_user WHERE id=$id";
        $result = mysqli_query($db, $query);
        $row = $result->fetch_assoc();

        $from = "nicole.marcus1@gmail.com";
        $to = $row['email'];
        $subject = "Urbanspace - Your issue has been resolved :)";
        $message = 'We are happy to update you that your issue has resolved !';
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "The email message was sent.";
    }
}

?>