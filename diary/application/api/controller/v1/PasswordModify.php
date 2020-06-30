<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 10:51
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\CheckID;
use app\api\validate\CheckPassword;
use think\Request;
use app\api\model\User as UserModel;
use app\api\lib\exception\SuccessMessage;
class PasswordModify extends BaseController
{
    public function update(Request $request){
        $this->isLogin();
        $params = $request->param();
        (new CheckPassword)->goCheck();
        $password = md5($params['newpassword']);
        $user_model = new UserModel;
        $user_model->save(['password'=>$password],['id'=>session('uid')]);
        throw new SuccessMessage();
    }
}