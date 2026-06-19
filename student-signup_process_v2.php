<?php

require "connection.php";

$email = $_POST["email"];
$id = $_POST["st_id"];
$institute = $_POST["institute"];
$branch = $_POST["branch"];

if (empty($id)) {
    echo ("Please enter your Student ID or NIC Number.");
}  elseif ($institute == "0") {
    echo ("Please select your Institute to continue registration.");
} elseif ($branch == "0") {
    echo ("Please select your Branch to continue registration.");
} else {

    Database::iud("UPDATE `student` SET `student_id`='$id', `branch_id`='$branch',`status_id`='1' WHERE `email`='$email'");
    echo ("success");
    
}

?>