<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/22
 * Time: 18:13
 */

namespace app\api\validate;


class CheckPhoto extends BaseValidate
{
    protected $rule = [
        'photo_url' =>'require|isEmpty'
    ];
    protected $message = [
        'photo_url'=>'头像地址不能为空'
    ];
}