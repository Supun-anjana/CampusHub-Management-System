<?php
require "connection.php";

$npw = $_POST["new_pw"];
$reenter_pw = $_POST["re_enter_pw"];
$email = $_POST["email"];

if(empty($npw)){
    echo("Please enter your new password to continue.");
}elseif(strlen($npw)<5 || strlen($npw)>20){
    echo("Your Password must contain 5 to 20 characters.");
}elseif(empty($reenter_pw)){
    echo("Please re-enter your new password to continue.");
}elseif($npw != $reenter_pw){
    echo("Password does not match. Please recheck again.");
}else{
    Database::iud("UPDATE `admin` SET `password`='".$npw."' WHERE `email`='".$email."'");
    echo("done");
}

?>