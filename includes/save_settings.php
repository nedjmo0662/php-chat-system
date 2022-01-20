<?php
    $data = (array)[];
    $Error = "";
    $data['userid'] = $_SESSION['userid'];
    $data['username'] = $DATA_OBJ->username;
    if(empty($DATA_OBJ->username))
    {
        $Error .= 'please enter a valid username . <br>' ;
    }else 
    {
        if(strlen($DATA_OBJ->username)<3) 
        {
            $Error .="username must be at least 3 charachters long . <br>";
        }
        // /^[a-z A-Z]*$/
        if(!preg_match("/^[a-z A-Z]*$/",$DATA_OBJ->username)) 
        {
            $Error .= 'please enter a valid username . <br>' ;
        }
    }
    if(empty($DATA_OBJ->gender))
    {
        $Error .= 'please select gender . <br>' ;
    }else {
        $data['gender'] = $DATA_OBJ->gender;
        if($DATA_OBJ->gender != 'male' && $DATA_OBJ->gender != 'female') {
            $Error .= 'please enter a valid gender . <br>';
        }
    }
    $data['password'] = $DATA_OBJ->password;;
    $password = $DATA_OBJ->password2;

    if(empty($DATA_OBJ->password)|| empty($password))
    {
        $Error .= 'please enter a valid password . <br>' ;
    }else 
    {
        if(strlen($DATA_OBJ->password)<7) 
        {
            $Error .="password must be at least 7 charachters long . <br>";
        }
        if($DATA_OBJ->password != $DATA_OBJ->password2) {
            $Error .= "the two password has to be similare";
        }
    }
    
    if($Error == "") {

        $sql = "UPDATE users SET username=:username,password=:password,gender=:gender WHERE userid=:userid LIMIT 1";
        $result = $DB->write($sql,$data);
        if($result){
            $info->message = 'your data was changed';
            $info->data_type = 'save_settings'; 
            echo json_encode($info);
        }else {
            $info->message = 'your data was not changed';
            $info->data_type = 'error'; 
            echo json_encode($info);
        }
    }else {
        $info->message = $Error;
        $info->data_type = 'error';
        echo json_encode($info);
    }
    