<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 22:17
 */

namespace app\api\lib\exception;


class EmailException extends BaseException
{
    public $status = 200;
    public $msg = '邮箱不存在';
    public $errorCode = 70000;
}