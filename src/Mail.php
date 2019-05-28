<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'XLSXReader.php';


class Mail{
    public static function sendMail($recipients){
        foreach ($recipients as $recipient){

            $mail = new PHPMailer();
            //echo $recipient['D'];
            // To load the French version
            $mail->setLanguage('de', 'vendor\phpmailer\phpmailer\language');

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = '6138@htl.rennweg.at';                     // SMTP username
                $mail->Password   = 'NPN1KA5S';                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('6138@htl.rennweg.at', 'Alex1');
               // $mail->addAddress('a.gruebling@gmail.com', 'Joe User');     // Add a recipient     // Name is optional
                $mail->addAddress($recipient['D']);
                $mail->addReplyTo('6138@htl.rennweg.at', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

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

                //$image = $_FILES['event-picture']['tmp_name'];
                //$aExtraInfo = getimagesize($_FILES['event-picture']['tmp_name']);
                //$sImage = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['event-picture']['tmp_name']));
                //echo '<img src="'.$sImage.'"/>';

                $pfile = fopen($_FILES['event-picture']['tmp_name'], "r") or die("Unable to open file!");
                $tempImagePath = $_FILES['event-picture']['tmp_name']."tempJPG.jpg";
                $tempFile = fopen($tempImagePath, "w") or die("Unable to open file!");
                $txt = fread($pfile,filesize($_FILES['event-picture']['tmp_name']));;
                fclose($pfile);
                fwrite($tempFile, $txt);
                fclose($tempFile);

                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->addEmbeddedImage($tempImagePath, "picture");
                $token = $recipient['token'];
                //$mail->addAttachment($_FILES['event-picture']['tmp_name']);
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
<a class="btn btn-primary" href="loginConformation/loginConformation.php?token=$token">Anmeldung & Details</a>
</body>
</html>
END;

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                unlink($tempImagePath);
                //echo 'Message has been sent';

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        echo '<div class="alert alert-success">
                  <strong>Success!</strong> Indicates a successful or positive action.
                </div>';
    }
}


