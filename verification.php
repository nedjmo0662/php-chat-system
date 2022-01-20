<?php
session_start();
require_once 'classes/autoloaded.php';
$DB = new Database();

$verification = $_GET['verification'];

//gettin the actual verification code
$data['userid'] = $_SESSION['userid'];
$query = "SELECT verification_code FROM users WHERE userid=:userid";
$result = $DB->read($query, $data);
$result = $result[0];
$actual_verification = $result->verification_code;


if($actual_verification == $verification)
{
    $sql ="UPDATE users SET verified = 1 WHERE userid = :userid LIMIT 1";
    $result = $DB->write($sql, $data);
    header("Location: login.php");
}else {
    header("Location: signup.php");
}