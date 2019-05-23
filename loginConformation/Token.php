<?php
namespace WienerLinien;
require_once('vendor/autoload.php');

class Token {
    public static function generateUserTokens(&$users) {
        //$users: [['first_name' => '', 'last_name' => '', 'token' => 'randomString', ..], [..], ..]

        foreach($users as $user) {
            if(!isset($user['token']))
                $user['token'] = self::generateToken();
        }
    }

    public static function generateToken($tokenLength = 16) {
        $token = '';
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $poolLength = strlen($pool);
        for ($i = 0; $i < $tokenLength; $i++) {
            $token .= $pool[rand(0, $poolLength - 1)];
        }
        return $token;
    }

    public static function useToken($token) {
        if(!isset($token))
            return false;

        $conn = \Doctrine\DBAL\DriverManager::getConnection(Database::DBPARAMS);

        $query = $conn->createQueryBuilder();
        $query
            ->select('pk_id')
            ->from('participants')
            ->where('token = ?')
            ->setParameter(0, $token);
        $query = $query->execute();

        $result = $query->fetch();

        if(!$result)
            return false;
        return $result['pk_id'];
    }
}

