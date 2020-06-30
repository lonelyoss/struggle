<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 20:26
 */

namespace app\api\controller\v1;


use app\api\lib\exception\UserException;
use app\api\model\User as UserModel;
use app\api\validate\CheckLogin;
use think\Request;

class Login
{
    public function login(Request $request){
        (new CheckLogin())->goCheck();
        $name = $request->post('name');
        $password = md5($request->post('password'));
        $user_model = new UserModel;
        $user = $user_model->where('name','=',$name)
            ->where('password','=',$password)
            ->find();
        if(!$user){
            throw new UserException([
                'msg'=>'用户名或者密码错误'
            ]);
        }
        session('uid',$user['id']);
        session('name',$user['name']);
        session('photo',$user['photo']);
        return json($user,200);
    }
}