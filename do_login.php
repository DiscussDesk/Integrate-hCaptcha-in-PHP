<?php
function is_entered_data_valid() {
    // This is just a basic type of validation for demo purpose. Replace this with your own server side validation
    if($_POST['email_id'] != "" && $_POST['password'] != "") {
        return true;
    } else {
        return false;
    }
}

if(is_entered_data_valid()) {

    if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response'])){
        $secret = "0x21A2A6D02ca2499d1B70Da6A309733fb50B2FAB5"; // Replace it with your generated secret key
        $remote_address = $_SERVER['REMOTE_ADDR'];
        $verify_url = "https://hcaptcha.com/siteverify?secret=".$secret."&response=".$_POST['h-captcha-response']."&remoteip=".$remote_address;
            // This is hcaptcha url
        $response = file_get_contents($verify_url); # Get token from post data with key 'h-captcha-response' and Make a POST request with data payload to hCaptcha API endpoint
        $responseData = json_decode($response);
        $success_msg="";
        $err_msg="";
        if($responseData->success){
            $success_msg = "You can process your login functionality";
        }else{
            $err_msg =  "Something went wrong while hCaptcha Validation. Please try again after sometime.";
        }

    }else{
        $err_msg =  "Please fill all the required fields";
    }

} else {
    // Server side validation failed
    $error_output = "Please fill all the required fields";
}

// Get the response and pass it into your ajax as a response.
$return_msg = array(
    'error'     =>  $err_msg,
    'success'   =>  $success_msg
 );
 echo json_encode($return_msg);

?>