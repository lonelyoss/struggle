<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:24
 */

namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\lib\exception\SuccessMessage;
use app\api\validate\CheckRegister;
class Register
{
    public function create(){
        //验证数据
        (new CheckRegister())->goCheck();
        //添加数据
        $params = input('post.');
        $params['password'] = md5($params['password']);
        $user_code = mt_rand(99,999).time();
        $params['user_code'] = $user_code;
        $user_model = new UserModel($params);
        $user_model->allowField(true)->save();
        //返回结果
        throw new SuccessMessage();
    }
}