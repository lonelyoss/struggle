<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:32
 */

namespace app\api\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    public $status = 200;
    public $msg = 'params error';
    public $errorCode = 10000;

    public function __construct($prompt = []){
        if(!is_array($prompt)){
            throw new Exception('prompt must be array');
        }
        if(array_key_exists('status',$prompt)){
            $this->status = $prompt['status'];
        }
        if(array_key_exists('msg',$prompt)){
            $this->msg = $prompt['msg'];
        }
        if(array_key_exists('errorCode',$prompt)){
            $this->errorCode = $prompt['errorCode'];
        }
    }
}