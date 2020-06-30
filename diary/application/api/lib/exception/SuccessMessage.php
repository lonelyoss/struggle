<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 18:36
 */

namespace app\api\lib\exception;


class SuccessMessage extends BaseException
{
    public $status = 200;
    public $msg = 'success';
    public $errorCode = 0;
}