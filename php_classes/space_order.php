<?php
require_once('config.php');

$spaceID = $book_date = "";
$i = 0;
$errors = array(); 

//Check for current orders for specific space in specific date
if($_POST["action"] == "check_booked_dates")
{
    $spaceID = mysqli_real_escape_string($db, $_POST["spaceID"]);
    $book_date = mysqli_real_escape_string($db, $_POST["book_date"]);
    $duration = mysqli_real_escape_string($db, $_POST["duration"]);
    //available_hours array = 
    //[0] = 17:00, [1] = 18:00, [2] = 19:00, [3] = 20:00, [4] = 21:00, [5] = 22:00
    $available_hours = array("0","0","0","0","0","0");
    $hour_index = 0;

    $query = "SELECT start_time, duration, finish_time FROM orders WHERE space_id=$spaceID AND date='$book_date'";
    $result = mysqli_query($db, $query);
    while($row = $result->fetch_assoc()) {
        switch($row["start_time"]) {
            case "17":
                $hour_index=0;
                for($i=0;$i<$row["duration"];$i++){
                    $available_hours[$hour_index] = "1";
                    $hour_index++;
                }
                break;
            case "18":
                $hour_index=1;
                for($i=0;$i<$row["duration"];$i++){
                    $available_hours[$hour_index] = "1";
                    $hour_index++;
                }
                break;
            case "19":
                $hour_index=2;
                for($i=0;$i<$row["duration"];$i++){
                    $available_hours[$hour_index] = "1";
                    $hour_index++;
                }
                break;
            case "20":
                $hour_index=3;
                for($i=0;$i<$row["duration"];$i++){
                    $available_hours[$hour_index] = "1";
                    $hour_index++;
                }
                break;
            case "21":
                $hour_index=4;
                for($i=0;$i<$row["duration"];$i++){
                    $available_hours[$hour_index] = "1";
                    $hour_index++;
                }
                break;
            case "22":
                $hour_index=5;
                $available_hours[$hour_index] = "1";
                break;
        }
    }
        $html = '';
        for($i = 0 ; $i < count($available_hours); $i++)
        {
            if($duration == 1){
                if($available_hours[$i] == "0"){
                    $html .= '
                        <button type="button" onclick="exposePaypalButton('.hourTranslate($i).','.$duration.')" class="btn btn-primary mt-1">'.hourTranslate($i).':00 - '.hourTranslate($i+1).':00</button>
                    ';
                }   
            }
            else {
                if($available_hours[$i] == "0"){
                    if(hourTranslate($i)!="22"){
                        $html .= '
                            <button type="button" onclick="exposePaypalButton('.hourTranslate($i).','.$duration.')" class="btn btn-primary mt-1">'.hourTranslate($i).':00 - '.hourTranslate($i+2).':00</button>
                        ';
                    }
                }
            }
        }
        echo $html;
}

if($_POST["action"] == "insert_new_order")
{
    $space_id = mysqli_real_escape_string($db, $_POST["space_id"]);
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $date = mysqli_real_escape_string($db, $_POST["date"]);
    $start_time = mysqli_real_escape_string($db, $_POST["start_time"]);
    $duration = mysqli_real_escape_string($db, $_POST["duration"]);
    $finish_time = mysqli_real_escape_string($db, $_POST["finish_time"]);
    $created_time = mysqli_real_escape_string($db, $_POST["created_time"]);

    $query = "
    INSERT INTO orders
    (username, space_id, date, start_time, duration, finish_time, created_time)
    VALUES ('$username', $space_id, '$date', '$start_time', $duration, '$finish_time', '$created_time');
    ";

    if(!mysqli_query($db, $query)){
        $html = '<div class="alert alert-danger" role="alert">Error while trying to run the following on the DB</div>';
        echo $html;
    }
    else {
        echo mysqli_insert_id($db);
    }
}

function hourTranslate($hour){
    switch($hour){
        case "0":
            return "17";
            break;
        case "1":
            return "18";
            break;
        case "2":
            return "19";
            break;
        case "3":
            return "20";
            break;
        case "4":
            return "21";
            break;
        case "5":
            return "22";
            break;
        case "6":
            return "23";
            break;
    }
}

?>