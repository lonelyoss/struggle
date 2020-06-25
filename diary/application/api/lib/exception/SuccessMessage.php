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
    public $data = [];
    public $pageUrl = null;
    public $msg = 'success';
    public $errorCode = 0;

    public function __construct(array $prompt = [])
    {
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
        if(array_key_exists('data',$prompt)){
            $this->data = $prompt['data'];
        }
    }

    public function success(){
        $arr['status'] = $this->status;
        $arr['data'] = $this->data;
        $arr['msg'] = $this->msg;
        $arr['errorCode'] = $this->errorCode;
        return json($arr,200);
    }
}