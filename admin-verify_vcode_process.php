<?php
require "connection.php";

$email = $_POST["email"];
$vcode = $_POST["vcode"];

if (empty($vcode)) {
    echo("Please enter verification code.");
}else{
    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='$email' AND `vcode`='$vcode'");
    $num = $rs->num_rows;

    if($num == 1){
        echo("done");
    }else{
        echo("Please enter the correct verification code that sent to your email address.");
    }
}

?>