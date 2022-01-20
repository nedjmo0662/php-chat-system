<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mychat</title>
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
    padding:0;
    margin:0;
}
body{
    background:#444;
    font-family: 'Open Sans', sans-serif;
}
@keyframes yeah{
            0% {
                opacity:0;
            }
            100% {
                opacity:1;
            }
}

.wrapper {
    max-width: 900px;
    background:#f0f0f0;
    height:500px;
    max-height:500px;
    display:flex;
    margin-left:auto;
    margin-right:auto;
    margin-top:10px;
    color:#fff;
    font-size:13px;
    overflow:hidden;
}

#left-pannel {
    background:#27344b;
    min-height:400px;
    flex:1;
    text-align:center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
#left-pannel #user-info span {
    display:block;
}
#left-pannel #user-info span:last-of-type{ 
    font-size:12px;
    opacity:0.5;
}
#left-pannel #profile-image {
    width:100px;
    height:100px;
    border-radius:50%;
    margin:10px;
}
#left-pannel label {
    width:100%;
    height:30px;
    display:block;
    background-color:#404b56;
    border-bottom:1px #ffffff55 solid;
    cursor:pointer;
    padding:5px;
    transition:all 0.5s ease;
}
#left-pannel label:hover {
    background-color:#4a5967;
}
#left-pannel>div label img {
    float:right;
    width:25px;
    height: 22px;
}
#left-pannel input[type='button']#logout {
padding: 10px 12px;
margin-bottom: 59px;
margin-left: auto;
margin-right: auto;
width: 6em;
background-color: #9e9e9e9e;
border: 1px solid #eee;
border-radius: 5px;
cursor: pointer;
color: #fff;
}
#right-pannel {
    min-height:400px;
    flex:4;

}
#header {
    background:#485b6c;
    height:70px;
    text-align:center;
    font-family:headfont;
    font-size:40px;
    position:relative;
}
.container {
    display:flex;
    
}
#inner-left-pannel {
    background-color:#3d3e46;
    flex:1;
    position: relative;
    text-align:center;
}
/* @media (max-width:767px)
{
    #inner-left-pannel{

        background-color: #3d3e46;
        flex: 0;
        width: 0px;
        flex-basis: 0%;
        position: relative;
        text-align: center;
        height: 100vh;
    }
    inner-right-pannel{
        background: #f2f7f8;
        height: 92vh;
        max-height: 100vh;
        flex: 1;
        flex-basis: 100%;
        transition: 1s ease;
        position: relative;
        overflow: hidden;
   
    }
    .wrapper{
        max-width: 100vw;
    background: #f0f0f0;
    height: 100vh;
    max-height: 100vh;
    display: flex;
    color: #fff;
    font-size: 13px;
    overflow: hidden;
    }
} */
#inner-right-pannel {
    background:#f2f7f8;
    height:430px;
    max-height: 500px;
    flex:2;
    transition: 1s ease;
    position:relative;
    overflow: hidden;
    /* overflow-y:scroll; */
}
.overlay {
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left:0;
    background:#444;
    opacity:0.7;
    z-index: 7;
}
::-webkit-scrollbar {
    width:5px;
    margin:0;
}
::-webkit-scrollbar-thumb {
    background-color: #37529c;
    border-radius: 6em;
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

#radio-contacts:checked ~ #inner-right-pannel {
    flex:0;
}
#radio-settings:checked ~ #inner-right-pannel {
    flex:0;
}
/* #radio-chat:checked ~ #inner-right-pannel {
    display: block;
} */
#answer {
    background-color:red;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    width:300px;
    height: 150px;
    color:#fff;
    border-radius: 20px;
    border: 2px solid #eee;
    text-align: center;
    display: none;
}
#contact {
    width: 100px;
    height:120px;
    margin:10px;
    display:inline-block;
    vertical-align: top;  
}
#contact img {
    width:100px;
    height:100px
}

#chat {
    position:relative;
    width: 100%;
    display: block;  
    height:75px;
    line-height:11px;
    text-align:center;
    border:solid thin #585555;
    background-color:#aaa;
    color:#3d3e46;
    cursor:pointer;
}
#chat div:hover {
    color:#fff;
}
#chat img {
    position: absolute;
    right: 0;
    top:0;
    width: 65px;
    height: 65px;
    border-radius: 50%;
    margin: 5px;
}

#message_left {
    color: black;
    display: flex;
    justify-content: flex-start;
    gap: 11px;
    text-align: center;
    align-items: center;
    margin: 10px;
    flex-wrap: wrap;
    position:relative;
}
#message_left > img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}
#message_left #message-content,#message_right #message-content {
    border-radius: 2em;
    justify-content: center;
    display: flex;
    max-width:85%;
    padding: 5px 10px;
    word-break: break-word;
    box-shadow: 0px 0px 32px 3px rgb(0 0 0 / 50%);
    flex-wrap: wrap;
}
#message_left #message-content {
    background-color: #4b7492;
    cursor:pointer;
}

#message_left p ,#message_right p{
    display: block;
    flex-basis: 100%;
    color: #fff;
}
#message_left p#half-date , #message_right p#half-date{
    font-size:7px;
}

#message_left p#full-date , #message_right p#full-date{
    display: block;
    position: absolute;
    top: 0;
    width: fit-content;
    color: black;
    left: 50%;
    transform: translateX(-50%);
}

#message_right {
    color: black;
    display: flex;
    justify-content: flex-end;
    gap: 11px;
    text-align: center;
    align-items: center;
    margin: 10px;
    flex-wrap: wrap;
    position:relative;
}
#message_right #message-content {
    background-color: #585555;
    cursor:pointer;
}
.loader-on { 
    position:absolute;
    margin-left:10px;
    left:0;
    top:0;
}
.loader-on img {
width:70px;
}

.image-on { 
    position:absolute;
    /* margin-left:10px; */
    left:50%;
    /* top:50%; */
    width:300px;
    transform:translateX(-50%);
    height:300px;
    background:#000;
    z-index: 8;
}
.image-off{ 
    display:none;
}


.loader-off{ 
    display:none;
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
@keyframes typing {
to {
    transform:translateY(-2px);
}
}
#typing-dots {
    position: relative;
    height: 30px;
    width: 50px;
    background: #4b7492;
    border-radius: 13px;
    padding: 5px 10px;
    
}
#typing-dots span{
    width: 5px;
    height: 5px;
    animation:typing 0.4s infinite alternate;
    background-color: #ffffff70;
    border-radius:5px;
}
#typing-dots span:nth-child(1){
    display: block;
    position: absolute;
    top: 35%;
    border-radius: 50%;
}
#typing-dots span:nth-child(2){
    display: block;
    position: absolute;
    top: 35%;
    left:20px;
    border-radius: 50%;
    animation-delay: 0.1s;
}
#typing-dots span:nth-child(3){
    display: block;
    position: absolute;
    top: 35%;
    left:30px;
    border-radius: 50%;
    animation-delay: 0.2s;
}

/* styling the pop up mess for deleting the mess */
.message-clicked{
    position:absolute;
    left: 50%;
    top: 50%;
    width: 200px;
    height: 100px;
    background: #454545;
    z-index: 999;
    transform: translate(-50%, -50%);
    border-radius: 5px;
    color:#fff;
    text-align:center;
}
.message-clicked p{
    color: #aaa !important;
    font-size: 15px;
}
.message-clicked button {
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-42%);
    padding: 6px 6px;
    border: none;
    border-radius: 5px;
    outline: none;
    color: #444;
    cursor: pointer;
}
.message-clicked .delete-btn {
    margin-left: 72px;
}
.message-clicked .cancel-btn {
    margin-left: -77px;
}
.message-clicked .show-image{
    left: 50%;
    transform: translateX(-50%);
}
</style>
<body>
    <div id="error"></div>
    <div class="wrapper">
        <div id="answer">
            <p id='pa'>are you sure</p>
            <button id="confirm">Confirm</button>
            <button id="cancel">Cancel</button>
        </div>

        <div id="left-pannel">
            <div id="user-info" style="padding:10px">
                <img id="profile-image" src= "" alt="">
                <span id="user-name">username</span>
                <span id="user-email">email@gmail.com</span>
                <br>
                <br>
                <br>
                <div>
                    <label id="label-chat" for="radio-chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label-contacts" for="radio-contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label-settings" for="radio-settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                    <label id="logout" for="radio-logout">logout <img src="./ui/icons/logout2.png" alt=""></label>
                </div>
            </div>
        </div>
        <div id="right-pannel">
            <header id="header">
                mychat
                <div id="loader-holder" class="loader-on">
                <img src= "ui/icons/giphy.gif" alt="">
                </div>
                <div id="image-viwer" class="image-off" onclick="closeImage(event)"></div>
            </header>
            <div class="container" >
                <div id="inner-left-pannel">
                
                </div>
                    <input type="radio" id="radio-chat" name="myradio" style="display:none">
                    <input type="radio" id="radio-contacts" name="myradio" style="display:none">
                    <input type="radio" id="radio-settings" name="myradio" style="display:none">
                    <div id="inner-right-pannel">
 
                </div>
            </div>
        </div>
    </div>
<script>
    var sent_audio = new Audio("message_sent.mp3");
    var received_audio = new Audio("message_received.mp3");
    var CURRENT_CHAT_USER = "";
    function _(id) {
        return document.getElementById(id);
    }
    
    //event listener
    var logout = _('logout');
    logout.addEventListener('click',logOut);

    var labelContacts = _('label-contacts');
    labelContacts.addEventListener('click',getContacts);

    var labelChats = _('label-chat');
    labelChats.addEventListener('click',getChats);

    var labelSettings = _('label-settings');
    labelSettings.addEventListener('click',getSettings);



    


   function get_data (find,type) {
        var xhr = new XMLHttpRequest();
        var loader = _('loader-holder');
        if(!(type == 'chats_refresh') && !(type == 'typing')){
            loader.className = 'loader-on';
        }
        xhr.onload = function () {

            if(xhr.readyState = 4 || xhr.status == 200) {
                (loader.className == 'loader-on') ? loader.className = 'loader-off' : null;
                handle_result(xhr.responseText,type);
            }
        }

        var data = {};
        data.find = find;
        data.data_type = type;
        var data = JSON.stringify(data);
        xhr.open('post','api.php',true);
        xhr.send(data);
    }
    
    function handle_result(result,type) {

        console.log(type, " ", result);
        if(result.trim() != ""){
            var innerRight = _('inner-right-pannel');
            innerRight.style.overflow = "visible";
            var obj = JSON.parse(result);
            if(typeof(obj.logged_in) != "undefined" && !obj.logged_in ){
                window.location = 'login.php';
            }else {
                switch(obj.data_type) {
                    case 'user_info':
                        var username = _('user-name');
                        var email = _('user-email');
                        var profileImage = _('profile-image');
                        var id = obj.id;
                        username.innerHTML = obj.username;
                        email.innerHTML = obj.email;
                        profileImage.src = obj.image;
                        break;
                    case 'contacts':
                            var innerLeft = _('inner-left-pannel');
                            innerRight.style.overflow = 'hidden';
                            innerLeft.innerHTML = obj.message;
                            
                        break;
                    case 'send_message':
                    sent_audio.play();
                    case 'chats':
                    if(obj.new_message == 1){
                        received_audio.play();
                    }
                        var radioChats = _('radio-chat');
                        if(radioChats.checked){
                        var innerLeft = _('inner-left-pannel');
                        var innerRight = _('inner-right-pannel');
                        innerRight.innerHTML = obj.messages;
                        innerLeft.innerHTML = obj.user;
                        var messageHolder = _("messages-holder");
                        
                        // (messageHolder != "undefined") ?  messageHolder.scrollTo(0,40000): null ;

                        (typeof(messageHolder !="undefined") && messageHolder != null) ? messageHolder.scrollTo(0,4000000):null;
                        if(obj.messages != ""){
                            let messag_text = _("message-text");
                            messag_text.focus();
                        }
                        }else {
                            // alert('chats');
                            innerRight.innerHTML = '';
                        }
                        break;

                    case 'chats_refresh':
                    if(obj.new_message == 1) {
                        received_audio.play();
                    }
                        var messageHolder = _('messages-holder');

                        messageHolder.innerHTML = obj.messages;
                        messageHolder.scrollTo(0,40000);
                    break;
                    case 'settings':
                        var innerLeft = _('inner-left-pannel');
                        innerLeft.innerHTML = obj.message;
                        innerRight.style.overflow = 'hidden';
                        innerRight.innerHTML = '';
                        break;
                    case 'save_settings':
                        get_data({},'user_info');
                        get_data({},'settings');
                        break;
                    case 'send_message':
                        

                        break;
                    case 'error':
                        var error = _("error");
                        error.innerHTML = obj.message;
                        error.style.display = 'block';
                        error.style.zIndex = 9999;
                        document.querySelector(".wrapper").addEventListener('click',()=>{
                            console.log('clickke');
                            error.style.display = 'none';
                            error.remove();
                        })
                        break;
                }
                    }
                }
    
            }
class Refresh {
    cunstructor(){
        this.chatRefresh = null;
        this.contRef = null;
    }
    start(){
        this.chatRefresh =  setInterval(()=>{
                        if(CURRENT_CHAT_USER != ""){
                            get_data({userid:CURRENT_CHAT_USER },"chats_refresh");
                        }else {
                            get_data({},"chats_refresh");
                        }
                        },2000)
    }
  stop(){
        clearInterval(this.chatRefresh)
    }

    startContRef(){
        this.contRef =  setInterval(()=>{
                        get_data({ },"contacts");
                    },2000)
    }
  stopContRef(){
        clearInterval(this.contRef)
    }
}

function logOut() {
        var answer = confirm("are you sure you want to logout?");
        if(answer){
            get_data({},'logout');
        }else {
            return;
        }
        
    }
    get_data({},'user_info');
    get_data({},'contacts');
    var radio_contacts = _('radio-contacts');
    radio_contacts.checked = true;
    var myIntCont = new Refresh;
    //start refreshing the contant
if(radio_contacts.checked){
        myIntCont.startContRef();
}
    function getContacts () {
        CURRENT_CHAT_USER = "";
        get_data({},'contacts');
    }

    function getChats () {
        (typeof(myIntCont) != "undefined")?myIntCont.stopContRef():null;
        let myInt = new Refresh;
        myInt.start();
        get_data({},'chats');
    }

    function getSettings () {
        myIntCont.stopContRef();
        CURRENT_CHAT_USER = "";
        get_data({},'settings');

    }
    function sendMessage (e) {
        if(e.key !== 'Enter' && e.type === 'keyup'){
            
            get_data({userid:CURRENT_CHAT_USER},'typing');
        }
        if(e.key === 'Enter' && e.type === 'keyup'){
            let messag_text = _("message-text");
            if(messag_text.value.trim() != ""){
                get_data({
                    message:messag_text.value.trim(),
                    userid:CURRENT_CHAT_USER,
                },'send_message');
            }
        }else if(e.type == 'click'){
            let messag_text = _("message-text");
            if(messag_text.value.trim() != ""){

                get_data({
                    message:messag_text.value.trim(),
                    userid:CURRENT_CHAT_USER,
                },'send_message');
            }
        }
    }





</script>

<script>

//handle the send button

function collectData(e) {
if(e.target.id == 'send-button'){
    var myform = _("myform");
    var message  = _("message");
    var data = {};
    var username = _('user-name');
    data.message = message.value; 
    data.reciverid = reciverid;
    sendData(data,'send_message');
}
else {
    var saveButton = _("save-button"); 
    saveButton.disabled = true;
    saveButton.value = "loading...please wait";
    var myform = _("myform");
    var inputs  = myform.getElementsByTagName("INPUT");
    var data = {};
    for(var i = inputs.length - 1; i>=0; i--) {
    var key = inputs[i].name;
    switch(key){
        case "username":
            data.username = inputs[i].value;
        break;

        case "email":
            data.email = inputs[i].value;
        break;

        case "gender":
            if(inputs[i].checked){
                data.gender = inputs[i].value;
            }
        break;
        case "password":
            data.password = inputs[i].value;
        break;

        case "password2":
            data.password2 = inputs[i].value;
            break;
    }
}
sendData(data,"save_settings"); 
    
}
}
function sendData(data,type) {
    var xml = new XMLHttpRequest();
    xml.onload = function() {
        if(xml.status == 200 || xml.readyState == 4) {
            handle_result(xml.responseText);
            var saveButton = _("save-button"); 
            saveButton.disabled = false;
            saveButton.value = "Save";
        }
    }
        data.data_type = type;
        var data_string = JSON.stringify(data);
        xml.open("POST","api.php",true);
        xml.send(data_string);
    
}
//send files through the messages 
function send_files_via_mes(files){
    let message = _('message-text').value;
    let fileType = files[0].type.split('/')[0];
    if(fileType == 'image'){
        var myForm = new FormData();
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(xhr.readyState == 4 || xhr.status == 200){
                get_data({userid:CURRENT_CHAT_USER },"chats");
            }
        }
    
            myForm.append('data_type',"send_files");
            myForm.append('userid',CURRENT_CHAT_USER);
            myForm.append('file',files[0]);
            myForm.append('message',message);
            xhr.open("POST","uploader.php",true);
            xhr.send(myForm);
    }else {
        const fileEr = {
            data_type: 'error',
            message: 'this file is not an image'
        }
        fileErString = JSON.stringify(fileEr);
        handle_result(fileErString);
    }
}
    // upload profile image function;
function upload_profile_image(files) {
    
        var changeimage = _("change-image-button"); 
        changeimage.disabled = true;
        changeimage.innerHTML = "Uploading Image...";
        
        var myform = new FormData();
        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if(xml.status == 200 || xml.readyState == 4) {
                // alert(xml.responseText);
                get_data({},'user_info');
                get_data({},'settings');
                changeimage.disabled = false;
                changeimage.innerHTML = "Change Image";
            }
        }
            myform.append('data_type',"change_profile_image");
            myform.append('file',files[0]);
            xml.open("POST","uploader.php",true);
            xml.send(myform);
}

function handle_drag_and_drop(e)
{
    if(e.type == "dragover")
    {
        e.preventDefault();
        e.target.className = "dragging";
    }
    else if (e.type == "dragleave") {
        e.target.className = '';
    }else if (e.type == "drop") {
        e.preventDefault();
        e.target.className = "";
        // console.log(this.files);
        upload_profile_image(e.dataTransfer.files);
    }else {
        e.target.className = "";
    }
}
function start_chat(e)
{

    var user = e.target.getAttribute('userid');
    if(e.target.id == "") {
        user = e.target.parentNode.getAttribute('userid');
    }
    CURRENT_CHAT_USER = user;
    var radio_chat = _("radio-chat");
    radio_chat.checked = true;
    //send userid to get the data from the database;
    get_data({userid:CURRENT_CHAT_USER },"chats");
    myInt = new Refresh;
    if(CURRENT_CHAT_USER != ""){
    myInt.start();
    }
    myIntCont.stopContRef();
    
} 

// function shows when the user click the message (right) to delete message;
function messag_choices(e){
    myInt.stop();

    let clickContent = e.target.children[0];
    if(typeof(clickContent) == "undefined"){
        clickContent = e.target.parentElement;
    }
    var pop = document.createElement('div');
    var id = e.target.parentNode.getAttribute('userid');
    if(e.target.id == "message-content"){
    if(id == null){
        var id = e.target.parentNode.parentNode.getAttribute('userid');
    }
    }else if(e.target.id == "delete-all") {
        var id = "delete_thread";
    }
    // var parent = document.querySelector("[userid='"+id+"']");
    var parent = document.querySelector("#messages-holder");
    pop.classList.add('message-clicked');
    parent.appendChild(pop);

    // create the black overlay
    let overlay = document.createElement('div');
    overlay.classList.add('overlay');
    let msgHolder = _('messages-holder');
    msgHolder.appendChild(overlay);

    overlay.onclick =()=>{
        if((clickContent.tagName.toLowerCase() == "div")){
            let imageHolder = _("image-viwer");
            imageHolder.className = "image-off";
            let image = imageHolder.children[0];
            image.remove();
        }
        //remove the overlay
        overlay.style.display  = 'none';
        overlay.remove();
        //remove th pop
        pop.style.display = 'none';
        pop.remove();
        myInt.start();
    }
    //the mess into the pop
    let popContent = document.createElement('p');
    popContent.innerText = 'do u want to delete this message';
    pop.appendChild(popContent);

    // create the button into the pop
    let deleteButton = document.createElement('button');
    deleteButton.innerText = 'delete';
    deleteButton.classList.add('delete-btn');
    pop.appendChild(deleteButton);

    //create cancel button
    let cancelButton = document.createElement('button');
    cancelButton.innerText = 'cancel';
    cancelButton.classList.add('cancel-btn');
    pop.appendChild(cancelButton);

    //if the message is an image button will be added for show the image
    if(clickContent.tagName.toLowerCase() == "div" ){
        var showImageBtn = document.createElement('button');
        showImageBtn.innerText = 'Show Image';
        showImageBtn.classList.add('show-image');
        pop.appendChild(showImageBtn);
    }


    // onclick event to cancel 
    cancelButton.addEventListener('click',()=>{
     //remove the overlay
        overlay.style.display  = 'none';
        overlay.remove();
        //remove th pop
        pop.style.display = 'none';
        pop.remove();
        myInt.start();
    })

    showImageBtn.addEventListener('click',(e)=>{
        pop.remove();
        let image = clickContent.innerHTML;
        let imageViwer = _("image-viwer");
        imageViwer.innerHTML = image;
        imageViwer.className = "image-on";

        // overlay.style.display  = 'none';
        // overlay.remove();
        //remove th pop
        pop.style.display = 'none';
        pop.remove();
        myInt.start();
    })

    // onclick event to the delete 
    deleteButton.addEventListener('click',()=>{
        overlay.style.display  = 'none';
        overlay.remove();
        get_data({
            messageid:id,
            userid:CURRENT_CHAT_USER
        },"delete_message");
        get_data({userid:CURRENT_CHAT_USER },"chats");
    });

}

function closeImage(e){
    let imageHolder = _(e.target.parentElement.id);
    imageHolder.className = "image-off";
    let image = imageHolder.children[0];
    image.remove();
    let overlay = document.querySelector(".overlay");
    overlay.style.display  = 'none';
    overlay.remove();

}


</script>
</body>
</html>
