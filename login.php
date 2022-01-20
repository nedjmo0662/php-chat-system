<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
    input[type=text] ,input[type=password] ,input[type=submit] {
        padding:10px;
        margin:10px;
        width:98%;
        border-radius:5px ;
        border: solid 1px grey;
        outline:none;
    }
    input[type=submit] {
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
        <div style=" font-family: 'Open Sans', sans-serif;font-size:20px;padding:10px">Login</div>
    </div>
    <div id="error"></div>
        <form id="myform">
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Login" id="login-button">
            <br>
            <a href="signup.php" style="display:block;text-align:center;text-decoration:none">
                dont have an account? Signup here
            </a>
        </form>
    </div>


    <script type="text/javascript">
function _(id) {
    return document.getElementById(id);
}
var signupButton = _('login-button');

signupButton.addEventListener('click' , collectData);

function collectData(e) {
    // e.preventDefalut();
    signupButton.disabled = true;
    signupButton.value = 'loading...please wait';
    var myform = _('myform');
    var inputs  = myform.getElementsByTagName('INPUT');
    // e.preventDefault();
    var data = {};

    for(var i = inputs.length - 1; i>=0; i--) {

        var key = inputs[i].name;

        switch(key){

            case 'email':
                data.email = inputs[i].value;
            break;
            case 'password':
                data.password = inputs[i].value;
            break;
        }
    }
    sendData(data,'login'); 


    
}

function sendData(data,type) {

    var xml = new XMLHttpRequest();

    xml.onload = function() {
        if(xml.status == 200 || xml.readyState == 4) {
            signupButton.disabled = false;
            signupButton.value = 'Login';
            handle_result(xml.responseText);
        }
    }
        data.data_type = type;
        var data_string = JSON.stringify(data);
        xml.open('POST','api.php',true);
        xml.send(data_string);
    
}

function handle_result(result){
   
    var data = JSON.parse(result);
    if(data.data_type == "info") {
        window.location = "index.php";
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
