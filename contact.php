<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD']=="POST")
{
$name= $_POST["name"];
$sendermail=$_POST["email"]; 
$message =$_POST["message"];
$recieve_mail="sharyarmail430@gmail.com";

try {
  // Server settings
  $mail->SMTPDebug = 2;                    
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'youremail@gmail.com';                     // SMTP username
  $mail->Password   = 'yourpassword';                               // SMTP password
  $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  // Recipients
  $mail->setFrom('from@example.com', 'Mailer');
  $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient


  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Recipe Sharing Platform';
  $mail->Body    = $message;
  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'Message has been sent';
}
catch (Exception $e) {
  echo "error :{$mail->ErrorInfo}";
}

}

?>














<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title id="title">Home</title>
  </head>

  <body>
    <main class="front_page" id="main_con">
      <aside class="the_nav">
        <?php 
        include "components/nav.php";
        ?>
      </aside>

      <section class="the_main_section">
     
<div class="contact_conatiner">
  <div class="heading">
    <h1>Contact Us</h1>
  </div>
  <form method="post" class="contact_form">
    <div class="personal_info">
      <input type="text" name="name" placeholder="Name..." id="name">
      <input type="text" name="email" placeholder="Email.." id="phone">
    </div>
    <div class="message">
      <textarea name="message" placeholder="Write a message..." id="" cols="70" rows="13"></textarea>
  
      <button type="submit">Submit</button>
    </div>
  </form>
  </div>



        





      </section>
    </main>

    <script src="js/index.js"></script>
  </body>
</html>
























