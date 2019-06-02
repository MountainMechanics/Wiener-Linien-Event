<?php
require 'vendor/autoload.php';


class smtpServerCredentialsTemp
{
    public static function smtpServerCredentialsData() {
        $smtpServerCredentials = array(
            'Host' => 'smtp-mail.outlook.com',
            'Username' => 'user',
            'Password' => 'password',
            'Port' => 587,
            'senderAccount' => 'example@example.com',
            'senderName' => 'Personalentwicklung'
        );
       return $smtpServerCredentials;
    }

}