<?php

require "connection.php";
session_start();

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];

$pattern = "/^[A-Z][a-z]{2,29}$/"; // Regex for First Name and Last Name
$mobile_pattern = "/^07[0-2,4-8]\d{7}$/"; // Regex for Mobile Number

if (empty($fname)) {
    echo ("Please enter your First Name.");
} elseif (!preg_match($pattern, $fname)) {
    echo ("Invalid Name! Must be 3-30 characters long, starting with a Capital letter followed by lowercase letters.");
} elseif (empty($lname)) {
    echo ("Please enter your Last Name");
} elseif (!preg_match($pattern, $lname)) {
    echo ("Invalid Name! Must be 3-30 characters long, starting with a Capital letter followed by lowercase letters.");
} elseif (empty($mobile)) {
    echo ("Please enter your mobile number to continue.");
} elseif (!preg_match($mobile_pattern, $mobile)) {
    echo ("Invalid Mobile Number! Please enter a 10-digit number starting with 07.");
} else {

    $result_set = Database::search("SELECT * FROM `admin` WHERE `mobile`='$mobile'");
    $num = $result_set->num_rows;

    if ($num > 0) {
        echo ("This Mobile Number is already registered. Please use a different Mobile Number.");
    } else {

        if (isset($_SESSION["admin"])) {
            $date = new DateTime();
            $timezone = new DateTimeZone("Asia/Colombo");
            $date->setTimezone($timezone);
            $joined_date = $date->format("Y-m-d");

            Database::iud("UPDATE `admin` SET `fname`='$fname',`lname`='$lname',`mobile`='$mobile',`joined_date`='$joined_date',`status_id`='3' 
            WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
            
            echo ("done");
        }
    }
}
