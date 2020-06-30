<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/30
 * Time: 15:17
 */

namespace app\api\validate;


class CheckUserCode extends BaseValidate
{
    protected $rule = [
        'id'    =>'require|max:13|checkCode'
    ];

    protected $message = [
        'id'   =>'用户不存在'
    ];

    protected function checkCode($value){
        if(!is_numeric($value)){
            return false;
        }else{
            return true;
        }
    }
}