<?php
$arr['userid'] = 'null';
if( isset($DATA_OBJ->find->userid)){
    $arr['userid'] = $DATA_OBJ->find->userid;
}
// task for me to complete ,whene the user click on 
//the chat it will apear a input feild that allwos him to send message 
$sql = "UPDATE users set typing = 0 WHERE userid =:sender";
$DB->write($sql,['sender' => $_SESSION['userid']]);

    $sql = "SELECT * FROM users WHERE userid=:userid LIMIT 1";
    $result = $DB->read($sql,$arr);
    if(is_array($result)) {
        //user found
        
        $arr['message'] = $DATA_OBJ->find->message;
        $arr['msgid'] = get_random_string_max(60);
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];


        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $arr['userid'];
        $sql = "SELECT * FROM messages WHERE sender=:sender and receiver = :receiver  or sender=:receiver and receiver = :sender LIMIT 1";
        $result2 = $DB->read($sql,$arr2);
        if(is_array($result2)) {
            $result2 = $result2[0];
            $arr['msgid'] = $result2->msgid;
        }

        $sql = "INSERT INTO messages (sender,receiver,message,date,msgid) values (:sender,:userid,:message,:date,:msgid)";
        $write = $DB->write($sql,$arr);
        
      //user info
        $result = $result[0];
        
        $image = ($result->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
        if(file_exists($result->image)){
            $image = $result->image;
        }
            $mydata = getUserData($result);
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
            position:absolute;
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
    
    //read from db
    $sql = "SELECT * FROM users WHERE  userid = :receiver ";
    $myuser = $DB->read($sql,['receiver' => $arr['userid']]);
    if(is_array($result))
    {
        $myuser = $myuser[0];
        $image = ($myuser->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
        if(file_exists($myuser->image)){
            $image = $myuser->image;
        }
    }

    $a['msgid'] = $arr['msgid'];
    $sql = "SELECT * FROM messages WHERE (sender=:sender && receiver = :receiver && deleted_sender = 0)  || (sender=:receiver && receiver = :sender && deleted_receiver = 0 && deleted_sender=0) order by id";
    $result2 = $DB->read($sql,$arr2);
    $_SESSION['timeWithDate'] = '';
    if(is_array($result2)) {
        foreach($result2 as $value){
            $value->image = $image;
            if($value->sender == $_SESSION['userid']){
                $messages .= message_right($value);
            }else {
                $value->image = $image;
                $messages .= message_left($value);
            }
        }
    }
    
    $messages .="</div>";
    
    $messages .= send_message();
        
        $info->user = $mydata;
        $info->messages = $messages;
        $info->data_type = "send_message";
        echo json_encode($info);
    }
    else {
        $info->message = "that contact was not found";
        $info->data_type = "send_message";
        echo json_encode($info);
    }
function get_random_string_max($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $length = rand(4,$length);
    $randomString = '';
    for($i=0; $i<$length; $i++)
    {
        $random = rand(0,$charactersLength-1);
        $randomString .= $characters[$random];
    }
    return $randomString;
}
?>

