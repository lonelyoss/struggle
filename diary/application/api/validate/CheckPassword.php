<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 11:06
 */

namespace app\api\validate;

use app\api\lib\exception\PasswordException;
use app\api\model\User as UserModel;
class CheckPassword extends BaseValidate
{
    protected $rule = [
        'oldpassword'=>'require|checkPassword',
        'newpassword'  => 'require|max:12|min:6|checkNewPassword',
        'repassword'  => 'require|confirm:newpassword',
    ];
    protected $message = [
        'oldpassword.require'=>'请输入旧密码',
        'oldpassword.checkPassword'=>'旧密码错误',
        'newpassword.require'  =>'请输入新密码',
        'newpassword.min'      =>'新密码不得少于6位',
        'newpassword.max'      =>'新密码不得多于12位',
        'newpassword.checkNewPassword'=>'新密码不能与旧密码一致',
        'repassword'        =>'两次密码不一致',
    ];

    protected $scene = [
        'find'  =>['newpassword','repassword']
    ];

    protected function checkPassword($value){
        $user_model = new UserModel;
        $password = $user_model->where('password','=',md5($value))->find();
        if(!$password){
            return false;
        }else{
            return true;
        }
    }


}