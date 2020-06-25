<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:31
 */

namespace app\api\validate;


class CheckLogin extends BaseValidate
{
    protected $rule = [
        'name'  =>'require',
        'password'=>'require'
    ];

    protected $message = [
        'name'  =>'用户名不得为空',
        'password'=>'密码不得为空'
    ];
}