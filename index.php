<?php
define('title', 'Demo to integrate hCaptcha in PHP form');
include "../includes/header.php"; 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Google reCapctha Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://hcaptcha.com/1/api.js" async defer></script>	
   <style>
   body{background-color:#f4f8fa;}
   </style>
   </head>

   <body>
      <div class="container col-sm-5" style="background-color:#ffffff; padding:25px; border: 1px solid #d9d8d8;">
         <h1 style="font-size: 21px; font-weight: bold;">Demo to Integrate hCaptcha in PHP</h1>
        
         <form action="" method="post">

         <div id="alert_message"></div>


            <div class="form-group">
               <label for="email">Email:</label>
               <input type="text" class="form-control" id="email_id" placeholder="Enter your Email" name="email_id" required>
            </div>
            <div class="form-group">
               <label for="pwd">Password:</label>
               <input type="text" class="form-control" id="password" placeholder="Enter your Password" name="password" required>
            </div>
            <div class="h-captcha" data-sitekey="118bb58f-05c1-4317-9e8a-54a84d3b63e5"></div>
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg" style="padding: 6px 46px; margin: 16px 0 0 0;">
            <div style="font-size: 12px; padding-top: 12px; color: #808080;">Note: This form is protected by hCaptcha.</div>
         </form>
      </div>

      <script>
        $('form').submit(function(event) {
            event.preventDefault(); //Prevent the default form submission
         
           // Making the simple AJAX call to capture the data and submit     
           $.ajax({
                        url: 'do_login.php',
                        type: 'post',
                        data: $('form').serialize(),
                        dataType: 'json',
                        success: function(response){
                            var error = response.error;
                            var success = response.success;
                            if(error != "") {
                                $('#alert_message').html(error);
                            }
                            else {
                                $('#alert_message').html(success);
                            }
                        },
                        error: function(jqXhr, json, errorThrown){
                            var error = jqXhr.responseText;
                            $('#alert_message').html(error);
                        }
                    });
   });
    </script>

   </body>
</html>



<?php include "../includes/footer.php"; ?>