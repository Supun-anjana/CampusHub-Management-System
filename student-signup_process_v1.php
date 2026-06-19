<?php
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];

$pattern = "/^[A-Z][a-z]{2,29}$/"; // Regex for First Name and Last Name

if (empty($fname)) {
    echo ("Please enter your First Name.");
} elseif (!preg_match($pattern, $fname)) {
    echo ("Invalid First Name.");
} elseif (empty($lname)) {
    echo ("Please enter your Last Name.");
} elseif (!preg_match($pattern, $lname)) {
    echo ("Invalid Last Name.");
} elseif (empty($email)) {
    echo ("Please enter your Email Address.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} elseif (empty($password)) {
    echo ("Please enter your Password.");
} else {

    $rs = Database::search("SELECT * FROM `student` WHERE `email`='$email'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Email Address is already registered. Please use a different Email Address.");
    } else {

        $date = new DateTime();
        $timezone = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($timezone);
        $joined_date = $date->format("Y-m-d");

        Database::iud("INSERT INTO `student`(`fname`, `lname`, `email`, `password`, `joined_date`, `status_id`) 
    VALUES ('$fname', '$lname', '$email', '$password', '$joined_date', '4')");
    
        echo ("success");
    }
}
