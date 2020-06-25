<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 12:20
 */

namespace app\api\controller;
use mail\Mailer;
class SendEmail
{
    public static function send($to,$subject,$body){

        $host = config('setting.email_host');
        $port = config('setting.email_port');
        $user = config('setting.email_username');
        $pass = config('setting.email_password');

        $from = config('setting.email_username');
        $fromName = config('setting.email_from_name');
        $mail = new Mailer($host,$port,$user,$pass,0);
        $send = $mail->email_send($from,$fromName,$to,$subject,$body);
        if(!$send){
            return false;
        }else{
            return true;
        }
    }
}