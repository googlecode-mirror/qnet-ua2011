<?php

namespace Qnet\Service;

include_once ("../external/validation/validation.php");
include_once ("../external/captcha/securimage.php");

use Securimage;


class Validator
{

    function validate()
    {
        $rules = array(); // stores the validation rules

        // standard form fields
        $rules[] = "required,userName,This field is required.";
        $rules[] = "required,userLastName,This field is required.";
        $rules[] = "required,email,Please enter your email address.";
        $rules[] = "valid_email,email,Please enter a valid email address.";
        $rules[] = "letters_only,userName,Please only enter letters (a-Z) in this field.";
        $rules[] = "required,password,Please enter a password.";
        $rules[] = "same_as,password,rePassword,Please ensure the passwords you enter are the same.";
        $errors = validateFields($_POST, $rules);

        return $errors;
        //            print_r($errors);
    }

    function validateCaptcha()
    {
        $securimage = new Securimage();
        //returns true if validation succeeds
        return $securimage->check($_POST['captcha_code']) == true;

        //if wrong captcha

        //        if ($securimage->check($_POST['captcha_code']) == false) {
        //            // the code was incorrect
        //            // you should handle the error so that the form processor doesn't continue
        //
        //            echo "Please go <a href='#' onclick='parseParameters()'>back</a> and try again.";
        //
        //            //    header("Location: /Qnet/target/classes/php/qnet/basura/fakelogin.php");
        //
        //            // or you can use the following code if there is no validation or you do not know how
        //            //  echo "The security code entered was incorrect.<br /><br />";
        //            //  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        //
        //
        //            exit;
        //        } else {
        //            echo"WIIIIIIII ";
        //        }

    }
}


////import form information
//$name = $_POST['name'];
//$password = $_POST['password'];


//error handling

//if no name was entered
//if (empty($name)) {
//    print "No name was entered. <br>Please include a name";
//    exit;
//}

//
//<script type="text/javascript">
//
//    var http = new XMLHttpRequest();
//
//    var url = "get_data.php";
//    var params = "lorem=ipsum&name=binny";
//    http.open("POST", url, true);
//
//    //Send the proper header information along with the request
//    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//    http.setRequestHeader("Content-length", params.length);
//    http.setRequestHeader("Connection", "close");
//
//    http.onreadystatechange = function() {//Call a function when the state changes.
//        if (http.readyState == 4 && http.status == 200) {
//            alert(http.responseText);
//        }
//    }
//    http.send(params);
//
//</script>

?>