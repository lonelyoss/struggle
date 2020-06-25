<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/20
 * Time: 23:13
 */

namespace app\api\lib\exception;


class CommentException extends BaseException
{
    public $status = 200;
    public $msg  = '评论不存在';
    public $errorCode = 10000;
}