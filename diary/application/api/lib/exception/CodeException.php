<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 22:46
 */

namespace app\api\lib\exception;


class CodeException extends BaseException{
    public $status = 200;
    public $msg = '验证码错误或者已过期';
    public $errorCode = 80000;
}