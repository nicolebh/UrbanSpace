<?php
error_reporting(E_WARNING);
require_once('php_classes/config.php');
session_start();

$name = $image = $date_of_create = '';

if(isset($_GET['spaceID']))
{
    $spaceId = $_GET['spaceID'];
    $query = "SELECT * from spaces WHERE id=$spaceId LIMIT 1";
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $date_of_create = date("Y-m-d");
    $image = $row['image'];
}

if(isset($_POST['issue_desc']))
{
    $errors = array(); 
    $issue_desc = mysqli_real_escape_string($db, $_POST["issue_desc"]);
    $date_of_create = date("Y-m-d");
    $spaceId = mysqli_real_escape_string($db, $_POST["spaceId"]);

    //Get User owner
    $query = "SELECT user_owner FROM spaces WHERE id=".$spaceId;
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    $space_owner = $row['user_owner'];

    //The user that create the issue
    $issue_user = $_SESSION["username"];

    if (empty($issue_desc) || empty($_FILES["issue_image"])) { array_push($errors, "All fields required"); }

    $image_target_dir = "include/issues/";
    $uploadOk = 1;
    $imageFileType = ltrim($_FILES["issue_image"]["type"], "image/");
    $image_target_file = $image_target_dir . "report-" . $spaceId ."-" . date("Y-m-d") . "." . $imageFileType;
    
    // Check if file already exists
    if (file_exists($image_target_file)) {
        array_push($errors, "Sorry, file already exists.");
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["issue_image"]["size"] > 5000000) {
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
        
        if (move_uploaded_file($_FILES["issue_image"]["tmp_name"], $image_target_file)) {
            $query = "INSERT INTO reports (space_id, description, image, date_of_create, space_owner, issue_user) VALUES ($spaceId,'$issue_desc','$image_target_file','$date_of_create','$space_owner','$issue_user')";
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
                header("Location: search.php");
            }
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
    header("Location: search.php");
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <title>
        Urban Space - Order
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php
      include('header.php');
    ?>
    <main>
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h1 class="display-4 p-5">Report an issue</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <img src="<?php echo $image;?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3 class="pb-2"><?php echo $name;?></h3>
                <h6><?php $mydate=getdate(date("U")); echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]"; ?></h6>
                <form action="report_an_issue.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="issue_desc">Issue Description</label>
                        <textarea class="form-control" id="issue_desc" name="issue_desc" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="issue_image">Image</label>
                        <input type="file" class="form-control" id="issue_image" name="issue_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Report</button>
                    <input type="text" style="visibility: hidden;" value="<?php echo $spaceId; ?>" name="spaceId" id="spaceId">
                </form>
            </div>
        </div>
    </div>
    </main>
    <footer class="page-footer font-small mdb-color darken-3 pt-4">
        <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
          <a href="index.php"> UrbanSpaces.com</a>
        </div>
    </footer>
</body>
</html>
