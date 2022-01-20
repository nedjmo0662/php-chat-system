<?php
// $sql = "UPDATE users set typing = 0 WHERE userid=:sender";
// $res = $DB->write($sql,['sender' => $_SESSION['userid']]);

$arr['userid'] = 'null';
$mydata = "";
$messages = "";
if( isset($DATA_OBJ->find->userid)){
    $arr['userid'] = $DATA_OBJ->find->userid;
    
}else {
    $er = '';
    $sql = "SELECT * FROM users where userid !=:userid ";
    $result = $DB->read($sql,['userid' => $_SESSION['userid']]);
    $mydata = "previous chats:<br>";
foreach($result as $user){
        $image = ($user->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
        if(file_exists($user->image)){
            $image = $user->image;
        }
        $sql = "SELECT * FROM messages  WHERE (messages.sender=:sender && messages.receiver =:receiver && messages.deleted_sender=0)  || (messages.sender=:receiver && messages.receiver=:sender && messages.deleted_sender=0 && messages.deleted_receiver=0)  order by id desc limit 1";
        // $sql = "SELECT * FROM messages join users on users.userid = messages.receiver";
        $out= $DB->read($sql,['receiver' => $user->userid , 'sender' => $_SESSION['userid']]);
        // $out= $DB->read($sql);
        if(is_array($out)){
            $message = $out[0];
            $content = $message->message;
            // if($message->typing != 0 && $message->typing == $_SESSION['userid'])  {
            //     $typing = "typing.. ";
            // }
           $sender = ($message->sender == $_SESSION['userid'])?  "<span style='color:#444'> you: </span>" : "<span style='color:#444'>received: </span>";
           
            $mydata .="
                    <div id='chat' userid='$user->userid' onclick='start_chat(event)' style='overflow:hidden;'>
                        <img src='$image' alt=''>
                        $user->username<br>
                        <div style='position: relative;
                        bottom: 27%;
                        transform: translateX(-25%);
                        display: inline-block;
                        font-size: 11px;
                        color: beige;
                        max-width: 155px;
                        max-height: 50px;
                        margin-top:30px;
                        margin-left:10px;'>".$sender. $content ."</div>
                        </div>";
        }else {
            continue;
        }
    }

    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chats";
    echo json_encode($info);
    die;
    
}
// task for me to complete ,whene the user click on 
//the chat it will apear a input feild that allwos him to send message
$refresh = false;
if(($DATA_OBJ->data_type == 'chats_refresh')){
    $refresh = true;
}
$sql = "SELECT * FROM users WHERE userid=:userid LIMIT 1";
$result = $DB->read($sql,$arr);
if(is_array($result) ){
        //user found
        $result = $result[0];
        $image = ($result->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
        if(file_exists($result->image)){
            $image = $result->image;
        }
        if(!$refresh){
            $result->image = $image;
            $mydata = getUserData($result);
        }
    if(!$refresh){
    $messages=  "
    <style>
        #send-button{
            float: right;
            padding: 4px;
            margin: auto;
            width:100%;
            max-width: 10%;
            height: 42px;
            border: 2px solid #aaa;
            border-radius: 11px;
            background-color: #689bf7;
            cursor:pointer;
            color:#aaa;
        }
        #message-text{
            position: absolute;
            margin: 0;
            width: 100%;
            max-width:80%;
            float: left;
            padding: 12px;
            border: 2px solid #ccc;
            border-bottom: none;
            color:#666;
            font-size:14px;
        }
    </style>
    
    <div id='messages-holder' style='height:90%; overflow-y:scroll;'>";
    }

    $sql = "SELECT * FROM users WHERE  userid = :receiver ";
    $myuser = $DB->read($sql,['receiver' => $arr['userid']]);
    if(is_array($myuser))
    {
        $myuser = $myuser[0];
        $typing = $myuser->typing;
        $image = ($myuser->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
        if(file_exists($myuser->image)){
            $image = $myuser->image;
        }
    }
    
    
    $arr2['sender'] = $_SESSION['userid'];
    $arr2['receiver'] = $arr['userid'];

    $sql = "SELECT * FROM messages WHERE (sender=:sender && receiver = :receiver && deleted_sender=0)  || (sender=:receiver && receiver = :sender && deleted_receiver=0 && deleted_sender=0) order by id";
    $result = $DB->read($sql,$arr2);
    $new_message = 0;
    $_SESSION['timeWithDate'] = '';
    if(is_array($result)) {
        
        foreach($result as $value){
            $value->image = $image;
            if($value->sender == $_SESSION['userid']){
                $messages .= message_right($value);
            }else {
                
                    


                        //check if there is new message
                        if($value->received == 0){
                            $new_message = 1;
                        }
                        //check if there is new message
                        // if($value->seen == 1){
                        //     $new_message = 0;
                        // }else {
                        //     $new_message = 1;
                        // }
                        
                        $DB->write("UPDATE messages SET received = 1 where receiver=:me ",['me' => $_SESSION['userid']]);
                        $messages .= message_left($value);

              
            }
        }
    }
    if($typing != 0){
        $sql = "SELECT * FROM users WHERE  userid=:receiver ";
        $myuser = $DB->read($sql,['receiver' => $arr['userid']]);

        //when the other(receiver) is typing is going to run this fun (like the messanger effect);
        $messages .= message_typing($myuser[0]);
    }
    
     //update the last seen to 0 to make seen apeare only in the last message in the ui 
     $sql = "UPDATE messages set seen = 0 WHERE (sender=:receiver && receiver = :sender) && seen = 1 order by id desc limit 1";
     $DB->write($sql,['receiver' => $DATA_OBJ->find->userid, 'sender' => $_SESSION['userid']]);
     //if the persone see or go inside the chats seen will updated to be 1;
     $sql = "UPDATE messages set seen = 1 WHERE (sender=:receiver && receiver = :sender) && seen = 0 order by id desc limit 1";
     $DB->write($sql,['receiver' => $DATA_OBJ->find->userid, 'sender' => $_SESSION['userid']]);

    if(!$refresh){
        $messages .="</div>";
        $messages .=send_message();
    }
        $info->user = $mydata;
        $info->data_type = "chats";
        if($refresh){
        $info->data_type = "chats_refresh";
        }
        $info->new_message = $new_message;
        $info->messages = $messages;
        echo json_encode($info);
}
else {
    
        $info->message = "that contact was not found";
        $info->data_type = "chats";
        echo json_encode($info);
        die;
}


?>

