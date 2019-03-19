<?php
namespace WienerLinien;
require_once "../vendor/autoload.php";

class Token {
    public static function generateUserTokens(&$users) {
        //$users: [['first_name' => '', 'last_name' => '', 'token' => 'randomString', ..], [..], ..]

        foreach($users as $user) {
            if(!isset($user['token']))
                $user['token'] = self::generateToken();
        }
    }

    public static function generateToken($tokenLength = 32) {
        $token = '';
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $poolLength = strlen($pool);
        for ($i = 0; $i < $tokenLength; $i++) {
            $token .= $pool[rand(0, $poolLength - 1)];
        }
        return $token;
    }
}