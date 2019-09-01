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
                    $hour_index++
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
        for($i = 0 ; $i < count($available_hours); $i++)
            echo $available_hours[$i];
}

?>