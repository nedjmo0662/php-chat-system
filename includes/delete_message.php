<?php

if(isset($DATA_OBJ->find->messageid)){
    $arr['messageid'] = $DATA_OBJ->find->messageid;
}

$sql = "SELECT * FROM  messages where id=:messageid";
$res = $DB->read($sql,[ 'messageid'=>$arr['messageid'] ]);
if($DATA_OBJ->find->messageid == 'delete_thread'){

    $arr2['receiver'] = $DATA_OBJ->find->userid;
    $arr2['sender'] = $_SESSION['userid'];
    // mark every message as deleted if the sender who delete the thread;
    $sql = "UPDATE  messages set deleted_sender=1 ,deleted_receiver=1 where (sender=:sender && receiver=:receiver)";
    $resu = $DB->write($sql,$arr2);
    //mark the messages of the reciever as deleted also 
    $sql = "UPDATE  messages set  deleted_receiver=1 where (sender=:receiver && receiver=:sender)";
    $resu = $DB->write($sql,$arr2);

}else {
    $arr['sender'] = $_SESSION['userid'];
    
    $sql = "UPDATE  messages set deleted_sender=1 where id=:messageid && sender=:sender";
    $DB->write($sql,$arr);
    
    $arr2['reciever'] = $DATA_OBJ->find->userid;
    $arr['sender'] = null;
    $sql = "UPDATE messages SET deleted_receiver=1 where id=:messageid && sender=:receiver";
    $res = $DB->write($sql,$arr);

    $arr = null;
}
