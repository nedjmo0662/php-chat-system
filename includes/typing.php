<?php

$sql = "UPDATE users set typing = 0 WHERE userid=:sender order by id desc limit 1";
$DB->write($sql,['sender' => $_SESSION['userid']]);

$sql = "UPDATE users set typing =:receiver WHERE userid=:sender order by id desc limit 1";
$res = $DB->write($sql,['receiver' => $DATA_OBJ->find->userid, 'sender' => $_SESSION['userid']]);
