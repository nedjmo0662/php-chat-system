<?php
    $info = (object)[];
    $data = false;

    $data['userid'] = $_SESSION['userid'];


    if(empty($Error)) {

        $query = "SELECT * FROM users WHERE userid =:userid limit 1";
    
        $result = $DB->read($query,$data);
        if(is_array($result))
        {
            $result = $result[0];
            $result->data_type = 'user_info';
            //check if image exists
            $image = ($result->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
            if(file_exists($result->image)){
                $image = $result->image;
            }
            $result->image = $image;
            echo json_encode($result);
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
