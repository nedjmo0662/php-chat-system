<?php

    // $info = (object)[];
    $data = false;
    //validate info
    $data['email'] = $DATA_OBJ->email;
    if(empty($DATA_OBJ->email)) 
    {
        $Error = 'please enter an email';
    }
    if(empty($DATA_OBJ->password)) 
    {
        $Error = 'please enter a password';
    }
    if($Error == "") {
    $query = "SELECT * FROM users WHERE email=:email && verified=1 limit 1";
    $result = $DB->read($query,$data);
    if(is_array($result) && count($result) > 0) 
    {
        $result = $result[0];
        
        if($result->password ==  $DATA_OBJ->password)
        {
            $query = "UPDATE users SET online=:online WHERE id=:id";
            $DB->write($query,['online' => 1,'id'=>$result->id]);
            $_SESSION['userid'] = $result->userid;
            $_SESSION['id'] = $result->id;
            $info->message = "logged in";
            $info->data_type = "info";
            echo json_encode($info);
        }else {
        $info->message = "wrong password";
        $info->data_type = "error";
        echo json_encode($info);
        }
    }else {
        $info->message = "wrong email";
        $info->data_type = "error";
        echo json_encode($info);
        
    }
    }
    else {
        $info->message = $Error ;
        $info->data_type = "error";
        echo json_encode($info) ;
    }