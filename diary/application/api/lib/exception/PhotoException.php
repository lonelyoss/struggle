<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/22
 * Time: 18:49
 */

namespace app\api\lib\exception;


class PhotoException extends BaseException
{
    public $status = 200;
    public $msg = '头像参数错误';
    public $errorCode = 50000;
}