<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:53
 */

namespace app\api\lib\exception;


use Exception;
use think\exception\Handle;

class ExceptionHandles extends Handle
{
    private $status;
    private $msg;
    private $errorCode;
    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            $this->status  = $e->status;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if(config('app_debug')){
                return parent::render($e); // TODO: Change the autogenerated stub
            }else{
                $this->status = 500;
                $this->msg = '服务器内部错误，不告诉你';
                $this->errorCode = 999999;
            }
        }
        $result = [
            'status'    => $this->status,
            'msg'       => $this->msg,
            'errorCode' => $this->errorCode,
            //'url'       =>request()->url(),
        ];
        return json($result);
    }
}