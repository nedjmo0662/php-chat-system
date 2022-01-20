<?php
session_start();


$DATA_ROW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_ROW);
$info = (object)[];
$Error = "";

// check if logged in
if(!(isset($_SESSION['userid'])) ) 
{
    if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
    {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }

}
require_once 'classes/autoloaded.php';
$DB = new Database();




//PROCCESS THE DATA;
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =='signup')  {

    //signup
    // $query = "INSERT INTO users (userid, username, email,password,date,gender) values (:userid,:username,:email,:password,:date,:gender)";
    // $data['username'] = 'nedjmo';
    // $data['password'] = 'password';
    // $data['email'] = 'ne@gmail.com';
    // $data['date'] = '2021-09-25 16:53:10    ';
    // $data['userid'] = '9949444';
    // $data['gender'] = 'male';
    // $res = $DB->write($query,$data);
    // if($res) {
    //     echo 'your account was created';die;
    // }
    require './includes/signup.php';

}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =='login'){
    //login
    require 'includes/login.php';

}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type =='user_info'){
    //user info
    require 'includes/user_info.php';
    
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'logout'){
    //logout
    require 'includes/logout.php';
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'contacts'){
    //logout
    require 'includes/contacts.php';
}
else if(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == 'chats'  || $DATA_OBJ->data_type == 'chats_refresh')){
    //logout
    require 'includes/chats.php';
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'settings'){
    //logout
    require 'includes/settings.php';
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'save_settings'){
    //save settings
    require 'includes/save_settings.php';
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'send_message'){
    //send message
    require 'includes/send_message.php';
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'typing'){
    require 'includes/typing.php';
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'delete_message'){
    require 'includes/delete_message.php';
}

function message_left($row) {
    $dateCompare = date("jS M Y" , strtotime($row->date));
    $date = date("g:iA" , strtotime($row->date));
    $isFull = false;
    if(!($dateCompare == $_SESSION['timeWithDate'])){
        $dateCompare = date("jS M Y" , strtotime($row->date));
        $_SESSION['timeWithDate'] = date("jS M Y" , strtotime($row->date));
        $date = date("jS M Y g:iA" , strtotime($row->date));
        $isFull = true;
    }
    $fullDate = ($isFull) ? "<p id='full-date'>".$date ."</p>" : "<p id='half-date'>".$date ."</p>";
    if($isFull){
    $style = 'color:black;display:flex;justify-content:flex-start;gap:11px;text-align:center;align-items:center;margin:10px;flex-wrap:wrap;';
    }else {
        $style = "color:black;display:flex;justify-content:flex-start;gap:2px;text-align:center;align-items:center;margin:10px;flex-wrap:wrap;flex-direction:row;";

    }
    $file = ($row->file != '' && file_exists($row->file)) ? "<div><img style='width:100%;' src='$row->file' /></div>":'';

    return "
    <div style=".$style." id='message_left' userid='$row->id'>
    <img src='$row->image' alt=''>
    <div id='message-content' onclick = 'messag_choices(event)'>
    $file
    $row->message
    ".$fullDate ."
    </div>
    </div>";
}


function message_right ($row){

    $dateCompare = date("jS M Y" , strtotime($row->date));
    $date = date("g:iA" , strtotime($row->date));
    $isFull = false;
    if(!($dateCompare == $_SESSION['timeWithDate'])){
        $dateCompare = date("jS M Y" , strtotime($row->date));
        $_SESSION['timeWithDate'] = date("jS M Y" , strtotime($row->date));
        $date = date("jS M Y g:iA" , strtotime($row->date));
        $isFull = true;
    }
    //check if the message has been saw and if the other people(sender) are typing;
    $seen = '';
    $typing = '';
    $image = $row->image;
    if($row->seen == 1){
        $seen = "<div id='seen' style='display: block;
        width: 20px;
        height: 20px;
        background: none;
        /* color: #aaa; */
        padding: 0;
        /* position: relative;
        color: #aaa;'><img style='width:100%;border-radius:50%' src='$image'></div>";
}

    $fullDate = ($isFull) ? "<p id='full-date'>".$date ."</p>" : "<p id='half-date'>".$date ."</p>";

    if(!$isFull){
        $style = "color:black;display:flex;justify-content:center;gap:2px;text-align:center;align-items:flex-end;margin:10px;flex-wrap:wrap;flex-direction:column;";
    }else {
        $style = 'color:black;display:flex;justify-content:flex-end;gap:11px;text-align:center;align-items:center;margin:10px;flex-wrap:wrap;';
    }
    // return the right message;

    $file = ($row->file != ''&& file_exists($row->file)) ? "<div><img style='width:100%;height:100%' src='$row->file' /></div>":'';
    return  "<div style= ".$style." id='message_right' userid='$row->id'>
    <div id = 'message-content' onclick = 'messag_choices(event)' >
    $file
    $row->message
    ".$fullDate."
    </div>
    $seen
    </div>";
}
function send_message(){
    return  "<div id='send-div' style='position:relative;'>
    <label  for='message-file' style='display:inline-block;width:50px'><img src='ui/icons/clip.png' style='opacity:0.8;width:30px;margin:5px;cursor:pointer;float:left'></label>
    <input onchange='send_files_via_mes(this.files)' id='message-file' type='file'  style='display:none'>
    <input onclick='sendMessage(event)'  type='submit' value='Send' id='send-button'>
    <input onkeyup='sendMessage(event)' type='text' placeholder='message' id='message-text'>
    </div>";
}

function message_typing($row) {
    return "
    <div id='message_left' userid='$row->id'>
    <img src='$row->image' alt=''>
    <div id='typing-dots'>
    <span></span>
    <span></span>
    <span></span>
    </div>
    </div>";
}


function getUserData($result) {
    return "
    <div id='chat' userid='$result->userid'>
        <img src='$result->image' alt=''>
        $result->username
        <div id='delete-all' onclick='messag_choices(event)'>Delete Thread</div>
        </div>";
}
