<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:29
 */

namespace app\api\validate;

use app\api\model\User as UserModel;
class CheckRegister extends BaseValidate
{
    protected $rule =[
        'name'  => 'require|max:12|checkName',
        'password'  => 'require|max:12|min:6',
        'repassword'  => 'require|confirm:password',
        'email'  => 'require|email|checkEmail',
        'vcode'  => 'require',
    ];
    protected $message = [
        'name.require'      =>'用户名不得为空',
        'name.max'          =>'用户名不得超过12个字符',
        'name.checkName'    =>'用户名已存在',
        'password.require'  =>'密码不得为空',
        'password.min'      =>'密码不得少于6位',
        'password.max'      =>'密码不得多于12位',
        'repassword'        =>'两次密码不一致',
        'email.require'     =>'邮箱不得为空',
        'email.email'       =>'邮箱格式错误',
        'email.checkEmail'  =>'邮箱已存在',
        'vcode'             =>'验证码错误',
    ];
    protected function checkName($value){
        $user_model = new UserModel;
        $user = $user_model->where('name','=',$value)->find();
        if($user){
            return false;
        }else{
            return true;
        }
    }


}