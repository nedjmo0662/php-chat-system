<?php
//strimentation;
$sql = "SELECT * FROM users WHERE userid=:userid limit 1";
$userid = $_SESSION['userid'];
$data = $DB->read($sql,['userid' => $userid]);
$myData = "";
if(is_array($data)){
    $data = $data[0];
    $image = ($data->gender == 'male')?"ui/images/user_male0.jpg":"ui/images/user_female.jpg";
    if(file_exists($data->image)){
        $image = $data->image;
    }
    $female = '';
    $male = '';
    ($data->gender == 'male' )? $male = "checked":$female = "checked";
$myData = 
'
<style type="text/css">
*{
    padding:0;
    margin:0;
    box-sizing:border-box;
}
@keyframes appear{
    0% {
        opacity:0;
        transform:  translateY(50px) rotate(5deg);
        transform-origin :0% 0%;
    }
    100% {
        opacity:1;
        transform-origin :0% 0%;
        transform :  translateY(0) rotate(0);
    }
}
    form {
        margin-left: auto;
        margin-right: auto;

    }
    input[type=text] ,input[type=password] ,input[type=button] {
        padding:10px;
        margin:10px;
        width:80%;
        border-radius:5px ;
        border: solid 1px grey;
        outline:none;

    }
    input[type=button] {
        cursor:pointer;
        background-color:#dedede;
    }
    input[type=radio] {
        transform:scale(1.2);
        cursor:pointer;
    }
    #left-pannel label {
        width: 100%;
        height: 30px;
        display: block;
        background-color: #404b56;
        border-bottom: 1px #ffffff55 solid;
        cursor: pointer;
        padding: 5px;
        transition: all 0.5s ease;
    }

    #error {
        text-align: center;
        padding:0.5em;
        background-color:#a75555;
        border-radius:5px;
        color:white;
        max-width:100%;
        margin:auto;
        display:none;
    }
    #change-photo {
        position:relative;
        height:260px;
        width:300px;
        text-align:center;
    }
    #change-photo img {
        width:200px;
        height:200px; 
        margin:10px;
        border-radius: 50%;
    box-shadow: 1px 3px 25px -2px rgb(0 0 0 / 50%);
    }
    #change-photo input {
        height:30px;
        margin:0;
        position:absolute;
        bottom:0;
        left:0;
        width:200px;
        margin:10px; 
    }
    #change-image-button  {
        padding: 10px;
        border-radius:7px;
        cursor:pointer;
    }
    .dragging{
        
        border:dashed #000 2px;
    }
</style>

    <div id="error">error</div>
    <div style="display:flex; animation:appear 1s ease;">
    <div id="change-photo"" >
    <span style="text-align:center; font-size:12px;">drag and drop an image to change</span> <br>
    <img ondragover="handle_drag_and_drop(event)" ondragleave = "handle_drag_and_drop(event)" ondrop = "handle_drag_and_drop(event)" src="'.$image.'" />
        <label for ="change-image-input" id="change-image-button" style="background-color: #194361;display:inline-block;x">
            Change image
        </label>
        <input type="file" onchange="upload_profile_image(this.files)" id="change-image-input" style="display:none">
    </div>
        <form id="myform" style="width:400px;" >
            <input type="text" name="username" placeholder="Username" value ="'.$data->username.'"><br>
            <input type="text" name="email" placeholder="Email" value="'.$data->email.'" readonly><br>
            <input type="password" name="password" placeholder="Password" value="'.$data->password.'"><br>
            <input type="password" name="password2" placeholder="Retype Password" value="'.$data->password.'"><br>
            <div style="position:relative;left:10px">
                <br>Gender:<br>
                <input id="male-gender" value="male" type="radio" name="gender" '.$male.'>
                <label for="male-gender">Male</label><br>
                <input id="female-gender" value="female" type="radio" name="gender"'.$female.'>
                <label for="female-gender">Female</label><br>
            </div>
            <input type="button" name="save" value ="Save" id="save-button" onclick="collectData(event)">
        </form>
    </div>
';


    $info->message = $myData;
    $info->data_type = "settings";
    echo json_encode($info); 
}else {
    $info->message = "No contacts were found";
    $info->data_type = "error";
    echo json_encode($info);
}
?>
