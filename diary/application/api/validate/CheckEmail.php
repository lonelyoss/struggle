<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 10:06
 */

namespace app\api\validate;


class CheckEmail extends BaseValidate
{
    protected $rule = [
        'email'=>'require|email|checkEmail',
    ];
    protected $message = [
        'email.require'     =>'邮箱不得为空',
        'email.email'       =>'邮箱格式错误',
        'email.checkEmail'  =>'邮箱已存在',
    ];
}