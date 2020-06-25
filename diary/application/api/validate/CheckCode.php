<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 23:32
 */

namespace app\api\validate;



class CheckCode extends BaseValidate
{
    protected $rule = [
        'code'  =>'require|max:6'
    ];
    protected $message = [
        'email'=>'邮箱错误',
        'code'=>'验证码错误'
    ];

}