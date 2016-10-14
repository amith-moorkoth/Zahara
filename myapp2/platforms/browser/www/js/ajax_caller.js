/**
 * Created by amith on 10/12/2016.
 */

function load_url(url,callback){
    myApp.showPreloader();
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            callback_ajax (myArr,callback);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function load_url_json(url,json_data,callback){
    myApp.showPreloader();
    $.post(url, json_data,
        function(data)
        {
            callback_ajax (JSON.parse(data),callback);
        });
}

function callback_ajax(data,callback){
    myApp.hidePreloader();
    callback(data);
}