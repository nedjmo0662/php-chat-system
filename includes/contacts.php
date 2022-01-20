<?php
$sql = "UPDATE users set typing = 0 WHERE userid=:sender";
$res = $DB->write($sql,['sender' => $_SESSION['userid']]);
//strimentation;
$query = "SELECT * FROM users WHERE  userid!=:userid";
$myusers = $DB->read($query,['userid' => $_SESSION['userid']]);
$myData = 
' 
<style>
@keyframes appear{
    0% {
        opacity:0;
        transform:  translateY(50px);
    }
    100% {
        opacity:1;
        transform :  translateY(0);
    }
}
#contact {
transition: all 0.5s cubic-bezier(.78,.11,.42,.85);
cursor:pointer;
position:relative;

}
#contact:hover{
    transform:scale(1.1);
}
</style>

<div id="contacts-holder"style="max-height:400px;overflow-y:scroll;text-align:center;">';
if(is_array($myusers)){
    //check for new msgs
    $me = $_SESSION['userid'];
    $sql = "SELECT * FROM messages where receiver = '$me' && received=0";
    $myMsgs = $DB->read($sql);
    $unreadMsgs = array();
    if(is_array($myMsgs)){
        foreach($myMsgs as $row){
            $sender = $row->sender;
            if(isset($unreadMsgs[$sender])){
                $unreadMsgs[$sender]++;
            }else {
                $unreadMsgs[$sender] = 1;
            }
        }
    }
    foreach($myusers as $myuser){
    $image = ($myuser->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
    if(file_exists($myuser->image)){
        $image = $myuser->image;
    }
        $myData .="
                <div id='contact' userid='$myuser->userid' onclick='start_chat(event)' userid='$myuser->id'>
                    <img src='$image' alt=''>
                    <br>
                    $myuser->username";
        if(count($unreadMsgs) > 0 && isset($unreadMsgs[$myuser->userid])){
            $userid = $myuser->userid;
            $myData .= "<div style='position:absolute;left:0;top:0;width:20px;height:20px;background-color:red;color:white;border-radius:50%;'>$unreadMsgs[$userid] </div>";
        }

        $myData .="  </div>";
    }
}else{
            // $myData .="<img src='ui/icons/giphy.gif' style = 'width:50px; margin-top:25%'></img>" ;
}
$myData .= '</div>';

    $info->message = $myData;
    $info->data_type = 'contacts';
    echo json_encode($info);
    die; 
    $info->message = "No contacts were found";
    $info->data_type = "error";
    echo json_encode($info);
?>
