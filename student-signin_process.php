<?php
require "connection.php";
session_start();

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rememberme"];

if (empty($email)) {
    echo ("Please enter your Email Address.");
} elseif (empty($password)) {
    echo ("Please enter your Password.");
} else {
    $rs = Database::search("SELECT * FROM `student` WHERE `email`='$email' AND `password`='$password'");
    $num = $rs->num_rows;
    if ($num == 1) {
        $data = $rs->fetch_assoc();
        if ($data["status_id"] == 1) { // Pending status
            echo ("Your account is currently pending approval. Please wait for the administrator to approve your account.");
        } elseif ($data["status_id"] == 2) {
            echo ("Your account has been blocked. Please contact the administrator for assistance.");
        } elseif ($data["status_id"] == 4) {
            echo ("incomplete");
        } else {
            $_SESSION["student"] = $data;
            if($rememberme == "true") {
                setcookie("student_email", $email, time() + (60*60*24*2 * 30), "/"); // 30 days
                setcookie("student_password", $password, time() + (60*60*24*2 * 30), "/"); // 30 days
            }else {
                setcookie("student_email", "", time() - 3600); // Expire the cookie
                setcookie("student_password", "", time() - 3600); // Expire the cookie
            }
            echo ("done");
        }
    }else{
        echo ("Invalid email or password. Please try again.");
    }
}
