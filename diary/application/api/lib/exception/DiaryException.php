<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/18
 * Time: 11:47
 */

namespace app\api\lib\exception;


class DiaryException extends BaseException
{
    public $status = 200;
    public $msg = '文章不存在';
    public $errorCode = 30000;
}