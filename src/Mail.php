<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'smtpServerCredentials.php';

class Mail{
    public static function sendMail($recipients){
       $smtpServerCredentials = smtpServerCredentials::smtpServerCredentialsData();
        foreach ($recipients as $recipient){
            $mail = new PHPMailer();

            // To load the German version
            $mail->setLanguage('de', 'vendor\phpmailer\phpmailer\language');

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = $smtpServerCredentials['Host'];  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $smtpServerCredentials['Username'];                     // SMTP username
                $mail->Password   = $smtpServerCredentials['Password'];                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = $smtpServerCredentials['Port'];                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($smtpServerCredentials['senderAccount'], $smtpServerCredentials['senderName']);

                $mail->addAddress($recipient['D']);
                $mail->addReplyTo($smtpServerCredentials['senderAccount'], 'Information');

                // Content
                $heading = $_POST['eventTitel'];
                $subheading = $_POST['eventUTitel'];
                if($recipient['A'] === 'Herr'){
                    $anrede = 'Sehr geehrter ';
                }else if($recipient['A'] === 'Frau'){
                    $anrede = 'Sehr geehrte ';
                }else{
                    return;
                }
                $desc = $anrede.$recipient['A'].' '.$recipient['C'].'<br>'.$_POST['event-descr'];

                $pfile = fopen($_FILES['event-picture']['tmp_name'], "r") or die("Unable to open file!");
                $tempImagePath = $_FILES['event-picture']['tmp_name']."tempJPG.jpg";
                $tempFile = fopen($tempImagePath, "w") or die("Unable to open file!");
                $txt = fread($pfile,filesize($_FILES['event-picture']['tmp_name']));
                fclose($pfile);
                fwrite($tempFile, $txt);
                fclose($tempFile);

                $mail->isHTML(true);// Set email format to HTML
                $mail->Encoding = 'base64';
                $mail->CharSet = 'UTF-8';
                $mail->addEmbeddedImage($tempImagePath, "picture");
                $token = $recipient['token'];
                $mail->Subject = 'Eventeinladung';
                $mail->Body    = <<<END
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="text-align: center;">
<h1>$heading</h1>
<h3>$subheading</h3>
<img src="cid:picture"/>
<p>$desc</p>
<a class="btn btn-primary" href="http://10.14.83.118/Wiener-Linien-Event/loginConformation/loginConformation.php?token=$token">Anmeldung & Details</a>
</body>
</html>
END;

                $mail->AltBody = $heading.'\n'.$subheading.'\n'.$desc;

                $mail->send();
                unlink($tempImagePath);

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                echo $e;
            }
        }
    }
}

