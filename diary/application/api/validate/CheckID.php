<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 18:48
 */

namespace app\api\validate;


class CheckID extends BaseValidate
{
    protected $rule = [
        'id'    =>  'require|mustInteger|number'
    ];
    protected $message = [
        'id'    =>  'id必须为正整数'
    ];

}