<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/17
 * Time: 17:21
 */

namespace app\api\controller\v1;

use app\api\lib\exception\UserException;
use app\api\model\User as UserModel;
use app\api\validate\CheckUserCode;
use think\Request;

class User
{
    public function get(Request $request){
        (new CheckUserCode())->goCheck();
        $uid = $request->param('id');
        $user_model = new UserModel;
        $result = $user_model->getAll($uid);
        if(!$result && empty($request)){
            throw new UserException();
        }
        return json($result);
    }


}