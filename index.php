<?php
require("/home/emailwor/public_html/src/Exception.php");
require("/home/emailwor/public_html/src/PHPMailer.php");
require("/home/emailwor/public_html/src/SMTP.php");
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->SMTPDebug = 0;                                                   // Enable verbose debug output
$mail->isSMTP();                                                        // Set mailer to use SMTP
$mail->Host       = 'mail.email-workshops.tech';                        // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                               // Enable SMTP authentication
$mail->Username   = 'no1@email-workshops.tech';                         // SMTP username
$mail->Password   = 'gYDMrZpXXm0F';                                     // SMTP password
$mail->SMTPSecure = 'tls';                                              // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 587;                                                // TCP port to connect to

error_reporting(E_ALL ^ E_NOTICE);

//Recipients
$mail->setFrom('no1@email-workshops.tech', 'No1');
$mail->addAddress('dominykas.galkus@hostinger.com', 'Dominykas Galkus');
$mail->addCC($_POST['cc']);

//Form to email format
if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
    $mail->Subject = 'PHPMailer Contact Form';
    $mail->isHTML(false);
    $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;

    if (!$mail->send()) {
        $msg = 'Sorry, something went wrong. Please try again later.';
    } else {
        $msg = 'Message has been sent! Thanks for your e-mail, I will contact you soon!';
    }
} else {
    $msg = 'Write something for me!';
} ?>

<!DOCTYPE html>
<html lang="en">
      <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
            body {font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box;}

            h1, h2 {
              text-align: center;
            }

            input[type=text], input[type=email], textarea {
              width: 100%;
              padding: 12px;
              border: 1px solid #ccc;
              border-radius: 4px;
              box-sizing: border-box;
              margin-top: 6px;
              margin-bottom: 16px;
              resize: vertical;
            }

            input[type=submit] {
              background-color: #4CAF50;
              color: white;
              padding: 12px 20px;
              border: none;
              border-radius: 4px;
              cursor: pointer;
            }

            input[type=submit]:hover {
              background-color: #45a049;
            }

            .container {
              border-radius: 5px;
              background-color: #f2f2f2;
              padding: 20px;
            } </style>

            <title>PHPMailer form</title>
      </head>

      <body>
            <div class="container">
                  <h1>PHPMailer Form</h1>

                  <?php if (!empty($msg)) {
                      echo "<h2>$msg</h2>";
                  } ?>

                  <form method="POST">
                      <label for="name">Name: <input type="text" name="name" id="name" placeholder="Your Name"></label><br><br>
                      <label for="email">From: <input type="email" name="email" id="email" placeholder="Your E-mail Address"></label><br><br>
                      <label for="to">To: <input type="email" name="to" id="to" value="Dominykas Galkus" readonly></label><br><br>
                      <label for="cc">CC: <input type="email" name="cc" id="cc" placeholder="Your E-mail Address"></label><br><br>
                      <label for="message">Message: <textarea name="message" id="message" style="height:200px" placeholder="Your Message"></textarea></label><br><br>
                      <input type="submit" value="Send">
                  </form>
            </div>
      </body>
</html>
