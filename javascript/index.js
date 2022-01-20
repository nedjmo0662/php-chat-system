function _(id) {
    return document.getElementById(id);
}

function get_data (find,type) {
    var xhr = new XMLHttpRequest();
    alert('ne');
    xhr.onload = function () {
        if(xhr.readyState = 4 || xhr.status == 200) {
            handle_result(xhr.responseText,type);
        }
    }
    var data = {};
    data.find = find;
    data.data_type = type;
    var data = JSON.stringify(data);

    xhr.open('POST','api.php',true);
    xhr.send(data);
}

function handle_result(result,type) {
    // alert(result);
    alert('nedjmo');
}
alert('podiu');
get_data({},'user_info');