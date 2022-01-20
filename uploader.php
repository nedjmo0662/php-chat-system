<?php

session_start();
require_once 'classes/autoloaded.php';
$DB = new Database();
$info = (object)[];



if(!(isset($_SESSION['userid'])) ) 
{
    if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
    {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }

}

$data_type = "";
if(isset($_POST['data_type']))
{
    $data_type = $_POST['data_type'];
}

$destination = "";
if(isset($_FILES['file']) && $_FILES['file']['name']!= "") 
{
    $fileType = explode("/",$_FILES['file']['type'])[0];
   
        if($_FILES['file']['error'] == 0 && $fileType == "image") 
        {
            //every thing is good
            $folder = "uploads/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            $destination = $folder . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],$destination);
    
            $info->message = "your image was uploaded";
            $info->data_type = $data_type;
            echo json_encode($info);
        }else {
        	if($_FILES['file']['error'] != 0){
        		$info->error = "ther is an error";
            		$info->data_type = $data_type;
            		echo json_encode($info);
        	}else {
        		$info->error = "only images allowed";
            		$info->data_type = $data_type;
            		echo json_encode($info);
        	}
            die;
        }
    
}

if($data_type == "change_profile_image")
{
    if($destination != "")
    {
        $id = $_SESSION['userid'];
        $sql ="UPDATE users SET image = '$destination' WHERE userid = '$id' LIMIT 1";
        $result = $DB->write($sql);
    }
}else if($data_type == "send_files") 
{
   
    if($destination != "")
    {
        $arr2['sender'] = $_SESSION['userid'];
        (isset($_POST['userid'])) ? $arr2['receiver']  = addslashes($_POST['userid']):$arr['userid'] = "";
        $arr['msgid'] = get_random_string_max(60);
        $sql = "SELECT * FROM messages WHERE sender=:sender and receiver = :receiver  or sender=:receiver and receiver = :sender LIMIT 1";
        $result2 = $DB->read($sql,$arr2);
        if(is_array($result2)) {
            $result2 = $result2[0];
            $arr['msgid'] = $result2->msgid;
        }

        // $arr['message'] = $DATA_OBJ->find->message;
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];
        $arr['receiver'] = $arr2['receiver'];
        $arr['file'] = $destination;
        $arr['message'] = $_POST['message'];
        $sql = "INSERT INTO messages (sender,receiver,file,message,date,msgid) values (:sender,:receiver,:file,:message,:date,:msgid)";
        $result = $DB->write($sql,$arr);
    }
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
