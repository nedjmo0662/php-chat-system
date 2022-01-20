<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
    $info = (object)[];
    $data = false;
    $data['userid'] = $DB->generate_id(20);    
    $data['date'] = date("Y-m-d H:i:s");
    //validate the username
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
    //validate the email
    $data['email'] = $DATA_OBJ->email;
    if(empty($DATA_OBJ->email))
    {
        $Error .= 'please enter a valid email . <br>' ;
    }else 
    {
        // if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$DATA_OBJ->email)) 
        // {
        //     $Error .= 'please enter a valid email . <br>' ;
        // }
        // $DATA_OBJ->email = filter_var($DATA_OBJ->email, FILTER_SANITIZE_EMAIL);
        if(filter_var($DATA_OBJ->email, FILTER_VALIDATE_EMAIL) === false) {
            $Error .= 'please enter a valid email . <br>' ;
        }
    }
    $data['gender'] = $DATA_OBJ->gender;
    if(empty($DATA_OBJ->gender))
    {
        $Error .= 'please select gender . <br>' ;
    }else {
        
        if($DATA_OBJ->gender != 'male' && $DATA_OBJ->gender != 'female') {
            $Error .= 'please enter a valid gender . <br>';
        }
    }

    //validate the password
    $data['password'] = $DATA_OBJ->password;
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
            $Error .= "the two password has to be the same";
        }
    }

    
    if($Error == '') {

         $fromEmail = "crazyboy0662@gmail.com";
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = str_replace("/api.php","",$actual_link);
        $verification = $data['username'] . time();
        $message = $actual_link . "/verification.php/?verification=" . $verification;
        $to = $data['email'];
        $subject = "sending an email";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();

        $message = '<!doctype html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Document</title>
                </head>
                <body>
                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
                    <div class="container">
                    '.$message.'<br/>
                        Regards<br/>
                    '.$fromEmail.'
                    </div>
                </body>
                </html>';
            
        // $mail = @mail($to, $subject, $message, $headers);
        $mail = true;
        $data['verification'] = $verification;

        if($mail) {
        $query = "INSERT INTO users (userid,username,email,password,date,gender,verification_code) values (:userid,:username,:email,:password,:date,:gender,:verification)";

        $result = $DB->write($query,$data);

        if($result){
            $_SESSION['userid'] = $data['userid'];
            $info->message = "your profile was created check your email for verification link";
            $info->data_type = "info";
            echo json_encode($info) ;
        }else {

            $info->message = "oops something went wrong please try again";
            $info->data_type = "error";
            echo json_encode($info);
        }
        
    }else {

        $info->message = "your profile was not created check your email";
        $info->data_type = "error";
        echo json_encode($info);
    }
    }
    else {
        echo "shit4";die;
        // echo 'hello from else 2';die;
        $info->message = $Error;
        $info->data_type = "error";
        echo json_encode($info) ;
    }