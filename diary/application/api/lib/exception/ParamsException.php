<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:39
 */

namespace app\api\lib\exception;


class ParamsException extends BaseException
{
    public $status = 200;
    public $msg = 'params exception';
    public $errorCode = 10000;
}