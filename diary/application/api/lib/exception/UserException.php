<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 18:55
 */

namespace app\api\lib\exception;


class UserException extends BaseException
{
    public $status = 200;
    public $msg = '用户不存在，请检查参数';
    public $errorCode = 20001;
}