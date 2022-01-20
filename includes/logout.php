<?php
$query = "UPDATE users SET online = :online WHERe userid=:userid";
$DB->write($query,['online' => 0,'userid'=>$_SESSION['userid']]);

if(isset($_SESSION['userid']))
{
    unset($_SESSION['userid']);
}
// $info = (object)[];
$info->logged_in = false;
echo json_encode($info);