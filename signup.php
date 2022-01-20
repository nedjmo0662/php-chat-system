<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<style type="text/css">
    @font-face {
        font-family: headfont;
        src: url(ui/fonts/Summer-Vibes-OTF.otf);
    }
    *{
        box-sizing: border-box;
        margin:0;
        padding:0;
    }
    body{
        background:#ddd;
        font-family: 'Open Sans', sans-serif;
    }
    .wrapper {
        max-width: 900px;
        background:#f0f0f0;
        min-height:500px;

        margin-left:auto;
        margin-right:auto;
        margin-top:10px;
        color:grey;
        font-size:13px;
        position:relative;

    }
    form {
        margin : auto;
        padding:10px;
        width:100%;
        max-width:400px;
    }
    input[type=text] ,input[type=password] ,input[type=button] {
        padding:10px;
        margin:10px;
        width:98%;
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
    #header {
        background:#485b6c;
        text-align:center;
        font-family:headfont;
        font-size:40px;
        width:100%;
        color:#fff;
        border-radius:5px
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
</style>
<body>
    <div class="wrapper">

    <div id="header">
        My Chat
        <div style=" font-family: 'Open Sans', sans-serif;font-size:20px;padding:10px">sign up</div>
    </div>
    <div id="error">there is an error</div>
        <form id="myform">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="Retype Password"><br>
            <dive style="position:relative;left:10px">
                <br>Gender:<br>
                <input id="male-gender" value="male" type="radio" name="gender">
                <label for="male-gender">Male</label><br>
                <input id="female-gender" value="female" type="radio" name="gender">
                <label for="female-gender">Female</label><br>
            </dive>
            <input type="button" value ="Sign Up" id="signup-button">
            <br>
            <a href="login.php" style = "display:block; text-align:center; text-decoration:none">
                Already have an account? Login
            </a>
        </form>
    </div>
    <?php
        session_start();
        if(isset($_SESSION['userid'])){
            header('location:index.php');
            die;
        }
        ?>;
    <script>
function _(id) {
    return document.getElementById(id);
}
var signupButton = _('signup-button');

signupButton.addEventListener('click' , collectData);

function collectData(e) {

    signupButton.disabled = true;
    signupButton.value = 'loading...please wait';
    var myform = _('myform');
    var inputs  = myform.getElementsByTagName('INPUT');
    // e.preventDefault();
    var data = {};

    for(var i = inputs.length - 1; i>=0; i--) {

        var key = inputs[i].name;
        switch(key){
            case 'username':
                data.username = inputs[i].value;
            break;

            case 'email':
                data.email = inputs[i].value;
            break;

            case 'gender':
                if(inputs[i].checked){
                    data.gender = inputs[i].value;
                }
            break;

            case 'password':
                data.password = inputs[i].value;
            break;

            case 'password2':
                data.password2 = inputs[i].value;
                break;
        }
    }
    sendData(data,'signup'); 


    
}

function sendData(data,type) {

    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if(xml.status == 200 || xml.readyState == 4) {
            handle_result(xml.responseText);
            signupButton.disabled = false;
            signupButton.value = 'Sign Up';
        }
    }
        data.data_type = type;
        var data_string = JSON.stringify(data);

        xml.open('post','api.php',true);
        xml.send(data_string);
}


function handle_result(result){
    console.log(result);
    var data = JSON.parse(result);
    if(data.data_type == "info") {
        window.location = "login.php";
    }else {
        var error = _("error");
        error.innerHTML  = data.message;
        error.style.display="block";
    }
}

    </script>
    <!-- <script src="signup.js"></script> -->
    </body>
</html>