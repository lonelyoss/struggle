<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 21:44
 */

namespace app\api\controller;

use app\api\lib\exception\UserException;
class BaseController
{
    private $uid;

    public function __construct()
    {
        $this->uid = session('uid');
    }

    public function getUid(){
        return $this->uid;
    }

    public function isLogin(){
        if(empty($this->uid) || !$this->uid || $this->uid==null){
            throw new UserException([
                'msg'   =>'请先登录',
                'errorCode' =>20002
            ]);
        }
    }

    public function checkUser($user_id){
        if($user_id == $this->getUid()){
            return true;
        }else{
            throw new UserException([
                'msg'=>'用户不存在，或者你没有权限'
            ]);
        }
    }
}