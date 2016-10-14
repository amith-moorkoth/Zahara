/**
 * Created by amith on 10/12/2016.
 */
myApp.popup('.login-screen');
var my_web_url="http://localhost/zahara/index.php";

function chkpin(){
    var formData = myApp.formToJSON('#signup');
    load_url(my_web_url+"/pinchecker/check/"+formData.pincode,chkpin_callback);
    //alert(load_data);
    //var formData2 = {
    //    'pincode': '9'
    //}
    //myApp.formFromJSON('#signup', formData2);
}
function chkpin_callback(load_data){
    if(load_data[0] != null){
        var formData2 = {
            'pincode': load_data[0].pincode,
            'taluk': ''+load_data[0].Taluk,
            'district': ''+load_data[0].Districtname,
            'state': ''+load_data[0].statename
        };
        myApp.formFromJSON('#signup', formData2);
    }else{
        var formData2 = {
            'taluk': ' ',
            'district': ' ',
            'state': ' '
        };
        myApp.formFromJSON('#signup', formData2);
        myApp.alert('Please Provide Valid PinCode');
    }
}
/*SignUp*/
function signup(){

    var formData = myApp.formToJSON('#signup');
    if(formData.fulname == ''){
        myApp.alert('Please Provide Your Full Name');
    }else if(formData.taluk == ''||formData.district == ''||formData.state == ''){
        myApp.alert('Please Provide Your PinCode');
    }else if(validateemail(formData.email) && formData.email == ''){
        myApp.alert('Please Valid Email');
    }else if(validatephno(formData.phno)){
        myApp.alert('Please Valid Phone Number');
    }else if(formData.password == ''){
        myApp.alert('Please Password');
    }else{
        load_url_json(my_web_url+"/login_checker/signup_check",formData,signup_callback);
    }
    //alert(JSON.stringify(formData));
}

function signup_callback(data){
    alert(JSON.stringify(data));
}

function validateemail(email) {
    var x = email;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        return true;
    }else{
        return false;
    }
}

function validatephno(phno){
    var phone = phno;
    var phoneNum = phone.replace(/[^\d]/g, '');
    if(phoneNum.length > 6 && phoneNum.length < 11) {  return false;  }
    else{return true;}
}