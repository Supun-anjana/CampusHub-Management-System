<?php

require "connection.php";
session_start();

$email = $_POST["email"];
$password = $_POST["pw"];

if (empty($email)) {
    echo ("Please insert your Email Address to continue.");
} elseif (empty($password)) {
    echo ("Please enter your Password to continue.");
} else {
    $result_set = Database::search("SELECT * FROM `admin` WHERE `email`='$email' AND `password`='$password'");
    $num_of_results = $result_set->num_rows;

    if ($num_of_results == 1) {
        $data_row = $result_set->fetch_assoc();
        if ($data_row["status_id"] == 1) {  // Pending Status
            echo ("Your account is currently pending approval. You will receive an email notification as soon as it is activated.");
        } elseif ($data_row["status_id"] == 2) {  // Disable Status 
            echo ("Your account has been disabled by an administrator. Please contact campus support for further assistance.");
        } elseif ($data_row["status_id"] == 4) {  // Incomplete Status
            $_SESSION["admin"] = $data_row;
            echo ("incomplete");
        } else {  // Active Status
            $_SESSION["admin"] = $data_row;
            echo ("done");
        }
    } else {
        echo ("Invalid Email Address or Password. Please recheck again.");
    }
}
