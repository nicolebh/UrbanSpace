<?php
session_start();
if(isset($_SESSION["fullname"]) && $_SESSION["fullname"] == $_POST["fullname"]){
    echo "True";
}
else {
    echo "False";
}
?>