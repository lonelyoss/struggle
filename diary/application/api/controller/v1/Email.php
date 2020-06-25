<?php
/**
 * Created by PhpStorm.
 * User: wu-hao-rui
 * Date: 2020/6/24
 * Time: 10:01
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\lib\exception\SuccessMessage;
use app\api\lib\exception\UserException;
use app\api\validate\CheckEmail;
use app\api\validate\CheckID;
use think\Request;
use app\api\model\User as UserModel;
class Email extends BaseController
{
    public function update(Request $request){
        $this->isLogin();
        (new CheckID())->goCheck();
        $params = $request->param();
        $this->checkUser($params['id']);
        (new CheckEmail())->goCheck();
        if($params['id']!=$this->getUid()){
            throw new UserException([
                'msg'=>'这不是你的邮箱'
            ]);
        }
        $user_model = new UserModel();
        $user_model->save(['email'=>$params['email']],['id'=>$this->getUid()]);
        throw new SuccessMessage();
    }
}