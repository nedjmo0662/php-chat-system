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
        console.log(data.message);
    }
}