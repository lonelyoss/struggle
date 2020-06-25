<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/22
 * Time: 16:09
 */

namespace app\api\lib\exception;


class BookException extends BaseException
{
    public $status = 200;
    public $msg = '日记本不存在';
    public $errorCode = 40000;
}