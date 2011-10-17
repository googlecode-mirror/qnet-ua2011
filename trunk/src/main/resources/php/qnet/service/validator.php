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
        $rules[] = "required,userName,userName:This field is required.";
        $rules[] = "required,userLastName,userLastName:This field is required.";
        //$rules[] = "required,email,Please enter your email address.";
        //$rules[] = "valid_email,email,Please enter a valid email address.";
        //$rules[] = "is_alpha,userName,Please only enter letters (a-Z) in this field.";
        $rules[] = "is_alpha,userName,userName:User name alphanumeric field.";
        $rules[] = "required,password,password:Please enter a password.";
        $rules[] = "same_as,password,rePassword,rePassword:Please ensure the passwords you enter are the same.";
        $rules[] = "required,agreement,agreement:You didnt agree with the conditions of the application.";
        $errors = validateFields($_POST, $rules);

        return $errors;
        //            print_r($errors);
    }

    function validateCaptcha()
    {
        $securimage = new Securimage();
        //returns true if validation succeeds
        return $securimage->check($_POST['captcha_code']) == true;

    }
}
?>